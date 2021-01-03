// __token value
const __token = $('[name="csrf-token"]').attr("content");
$(document).ready(function () {
    bsCustomFileInput.init();
    $("[data-mask]").inputmask();
    /**
     * get all cities for any governorate
     */
    $(".governorate_id").change(function (event, cityId = null) {
        var governorate_id = $(this).val();
        var citySelectBox = $('[name="' + $(this).data("name") + '"]');
        citySelectBox.html("");
        $.get("/get-cities", { governorate_id: governorate_id }, (data) => {
            $.each(
                data,
                (_index, city) => {
                    citySelectBox.append(
                        $("<option></option>").val(city.id).html(city.name)
                    );
                },
                "json"
            );
            //change city box value
            if (cityId) {
                citySelectBox.val(cityId);
            }
        });
    }); // end of $(".governorate_id")

    $(document).on("submit", ".addPlacePrice", function (e) {
        e.preventDefault();
        form = this;
        formdata = new FormData(form);
        $.ajax({
            url: form.action,
            type: "POST",
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data.code == 200) {
                    var alertDiv = '<div class="alert alert-success">';
                    alertDiv += "<h5>" + data.title + "</h5></div>";
                    $(".modal-body").html(alertDiv);
                    getOrderChargePrice();
                }
            },
            error: function (reject) {
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) {
                    $("#" + key).addClass("is-invalid");
                    $("#" + key).after(
                        '<span class="error invalid-feedback">' +
                            val[0] +
                            "</span>"
                    );
                });
            },
        });
        return false;
    });

    $("#orderStatus").change(function () {
        $("#changeStatus").submit();
    });

    $("#customer_type").change(function () {
        $("#customer").submit();
    });

    $("#getCitiesPriceSelect").change(function () {
        $("#getCitiesPrice").submit();
    });
    $(document).on("click", ".showSingleModel", function () {
        $.get(this.href, {}, function (data) {
            newFunction(data);
        });
        return false;
    });

    $(document).on("click", ".showInOpenModal", function () {
        $.get(this.href, {}, function (data) {
            $("#modal-default .modal-body").html("");
            $("#modal-default .modal-body").html(data);
        });
        return false;
    });
    /// print order num
    $(document).on("click", ".button-print", function () {
        $("#modal-print").modal("hide");
        $("#modal-print").on("hidden.bs.modal", function (e) {
            $("#modal-print").off("hidden.bs.modal");
            window.print();
        });
        return false;
    });

    ////////////////////////////////////////////////////////////////////////////////
    $(document).on("submit", "#FormSubmit", function (e) {
        e.preventDefault();
        var form = this;
        var formdata = new FormData(form);
        var MainForm = $(this);
        resetErorrClasses(MainForm);
        $.ajax({
            url: form.action,
            type: "POST",
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            success: function (responseData) {
                mainAlertBody(responseData.alert);
            },
            error: function (reject) {
                if(reject.status == 422){
                   setErrorsClassToInputsFildes(reject.responseJSON.errors);
                }else{
                    mainAlertBody(reject.responseJSON.alert);
                }
            },
        });
        return false;
    });
    /**
     *  order add
     */
});
////////////////////////////////////////////////////////////////////////////
$("#selectAllPlaces").click(function () {
    var clicks = $(this).data("clicks");
    if (clicks) {
        $(".placeIndex input[type=checkbox]").prop("checked", false);
    } else {
        $(".placeIndex input[type=checkbox]").prop("checked", true);
    }
    $(this).data("clicks", !clicks);
    placeEditAndDeleteMultiCitiesButtonToggle();
});
$(".placeIndex input[type=checkbox]").change(function () {
    placeEditAndDeleteMultiCitiesButtonToggle();
});

function placeEditAndDeleteMultiCitiesButtonToggle() {
    const placeEditMultiCitiesButton = $(".placeEditMultiCitiesButton");
    const placeDeleteMultiCitiesButton = $(".placeDeleteMultiCitiesButton");
    var cities_ids = [],
        checkedCount = 0;
    placeEditMultiCitiesButton.addClass("disabled");
    placeDeleteMultiCitiesButton.addClass("disabled");

    $(".placeIndex input[type=checkbox]:checked").each(function () {
        checkedCount += 1;
        cities_ids.push($(this).val());
    });
    if (checkedCount > 0) {
        placeEditMultiCitiesButton.removeClass("disabled");
        placeDeleteMultiCitiesButton.removeClass("disabled");
    }
    placeEditMultiCitiesButton.attr("cities_ids", cities_ids);
    $("input[name=cities_ids]").val(cities_ids);
}

$("#getAllCityForPlace").change(function () {
    $("#placeIndexForm").submit();
    //window.location.assign(`/place?governorate_id=${$(this).val()}`);
});

$(".placeEditMultiCitiesButton").click(function () {
    var cities_ids = $(this).attr("cities_ids");
    if (cities_ids != "") {
        window.location.assign(
            `/place/edit-multi-cities?cities_ids=${cities_ids}&governorate_id=${$(
                "[name=governorate_id]"
            ).val()}`
        );
    }
});

$("select[name=paginate]").change(function () {
    $("#placeIndexForm").submit();
});
////////////////////////////////////////////////////////////////////////////

function newFunction(data) {
    $("#modal-default .modal-body").html("");
    $("#modal-default .modal-body").html(data);
    $("#modal-default").modal("show");
}

/*** get order charge price  */
var loadFile = function (event) {
    var output = document.getElementById("image-privew");
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
    };
};
function setErrorsClassToInputsFildes(errors) {
    var name = undefined;
    $.each(errors, function (key, val) {
        name = `[name=${key}]`;
        //check if key is array
        if (key.indexOf(".") != -1) {
            name = key.split(".");
            name = '[name="' + name[0] + "[" + name[1] + ']"]';
        }
        $(name).addClass("is-invalid");
        $(name).after(
            '<span class="error invalid-feedback">' + val[0] + "</span>"
        );
    });
}

/**
 * reset Erorr Classes
 *
 */
function resetErorrClasses(MainForm) {
    MainForm.find(".invalid-feedback").each(function () {
        $(this).remove();
    });
    MainForm.find(":input").each(function () {
        $(this).removeClass("is-invalid");
    });
}
/**
 * set sweet alert box data and fire it
 */
function mainAlertBody(alert) {
    Swal.fire({
        titleText: alert.title,
        icon: alert.icon,
        html: alert.html,
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
    });
}
