$(document).ready(function () {
    bsCustomFileInput.init();
    $("[data-mask]").inputmask();
    /**
     * get all cities for any governorate
    */
    $(".governorate_id").change(function () {
        var governorate_id = $(this).val();
        var citySelectBox = $('[name="'+ $(this).data('name') +'"]');
        citySelectBox.html("");
        $.get(
            "/get-cities",{ governorate_id: governorate_id},
            (data) => {
                $.each(
                    data,(_index, city) => {
                        citySelectBox.append(
                            $("<option></option>").val(city.id).html(city.name)
                        );
                    },
                    "json"
                );
            }
        );
    });// end of $(".governorate_id")

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
    $(document).on("click", ".print", function () {
        $.get(this.href, {}, function (data) {
            $("#print").html(data);
            $("#modal-print .modal-body").html("");
            $("#modal-print .modal-body").html(data);
            $("#modal-print").modal("show");
        });
        return false;
    });
    $(document).on("click", ".show-view-setting", function () {
        $("#option-modal").modal("show");
        return false;
    });
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
        $.ajax({
            url: form.action,
            type: "POST",
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data)
                window.location.assign(data.urlRedirect);
            },
            error: function (reject) {
                console.log(reject)
                if (reject.status == 500) {
                    Swal.fire({
                        title: reject.responseJSON.message,
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                    });
                } else {
                    $(".invalid-feedback").remove();
                    $("input").removeClass("is-invalid");
                    var response = $.parseJSON(reject.responseText);
                    var name = undefined;
                    console.log(response);
                    $.each(response.errors, function (key, val) {
                        name = `[name=${key}]`;
                        //check if key is array
                        if (key.indexOf(".") != -1) {
                            name = key.split(".");
                            name = '[name="' + name[0] + "[" + name[1] + ']"]';
                        }
                        $(name).addClass("is-invalid");
                        $(name).after(
                            '<span class="error invalid-feedback">' +
                                val[0] +
                                "</span>"
                        );
                    });
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

$(
    '[name="shipping[weight]"],[name="shipping[quantity]"],[name="shipping[price]"],[name="shipping[discount]"]'
).on("keyup touchend", function () {
    getOrderChargePrice();
});

$('[name="shipping[charge_on]"]').on("change", function () {
    getOrderChargePrice();
});

function newFunction(data) {
    $("#modal-default .modal-body").html("");
    $("#modal-default .modal-body").html(data);
    $("#modal-default").modal("show");
}

/*** get order charge price  */
function getOrderChargePrice() {
    var url = "/order/get-order-charge-price",
        weight = $('[name="shipping[weight]"]').val(),
        quantity = $('[name="shipping[quantity]"]').val(),
        price = $('[name="shipping[price]"]').val(),
        charge_on = $('[name="shipping[charge_on]"]').val(),
        city_id = $('[name=reciver_city_id]').val(),
        discount = $('[name="shipping[discount]"]').val();

    var data = {
        shipping : {
        weight: weight,
        quantity: quantity,
        price: price,
        charge_on: charge_on,
        discount: discount,
        },
        reciver_city_id: city_id
    };
    if (weight > 0 && quantity > 0) {
        $(".is-invalid").removeClass("is-invalid");
        $(".invalid-feedback").remove();
        $.get(url,data, function (data) {
            $.each(data, function (key, val) {
                $('[name="shipping[' + key + ']"]').val(val);
            });
        }).fail(function (reject) {
            var response = $.parseJSON(reject.responseText);
            var name = undefined;
            console.log(response);
            $.each(response.errors, function (key, val) {
                name = `[name=${key}]`;
                //check if key is array
                if (key.indexOf(".") != -1) {
                    name = key.split(".");
                    name = '[name="' + name[0] + "[" + name[1] + ']"]';
                }
                $(name).addClass("is-invalid");
                $(name).after(
                    '<span class="error invalid-feedback">' +
                        val[0] +
                        "</span>"
                );
            });
        });
    }
}
/*** get order charge price  */
var loadFile = function (event) {
    var output = document.getElementById("image-privew");
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src); // free memory
    };
};
