$(document).ready(function () {
    bsCustomFileInput.init();
    $("[data-mask]").inputmask();

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

    $("#governorate_id").change(function () {
        var id = $(this).val();

        $("#city_id").html("");
        $.get(
            "/get-cities",
            {
                governorate_id: id,
            },
            function (data) {
                $.each(
                    data,
                    function (_index, city) {
                        $("#city_id").append(
                            $("<option></option>").val(city.id).html(city.name)
                        );
                    },
                    "json"
                );

                if ($("#city_id").attr("data")) {
                    $("#city_id").val($("#city_id").attr("data"));
                }
                $("#city_id").removeAttr("data");
            }
        );
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
    $(document).on("click", ".button-print", function () {
        $('#modal-print').modal('hide');
        $('#modal-print').on('hidden.bs.modal', function (e) {
            $("#modal-print").off("hidden.bs.modal");
            window.print();
        });
        return false;
    });
});

$(
    '[name="shipping[weight]"],[name="shipping[quantity]"],[name="shipping[price]"],[name="shipping[discount]"]'
).on("keyup touchend", function () {
    getOrderChargePrice();
});

$('[name="shipping[charge_on]"]').on("change", function () {
    getOrderChargePrice();
});

function newFunction(data) {
    $(".modal-body").html("");
    $(".modal-body").html(data);
    $("#modal-default").modal("show");
}

/*** get order charge price  */
function getOrderChargePrice() {
    var url = "/order/get-order-charge-price",
        weight = $('[name="shipping[weight]"]'),
        quantity = $('[name="shipping[quantity]"]'),
        price = $('[name="shipping[price]"]'),
        charge_on = $('[name="shipping[charge_on]"]');
    discount = $('[name="shipping[discount]"]');

    var data = {
        weight: weight.val(),
        quantity: quantity.val(),
        price: price.val(),
        charge_on: charge_on.val(),
        discount: discount.val(),
    };
    if (weight.val() > 0 && quantity.val() > 0) {
        $(".is-invalid").removeClass("is-invalid");
        $(".invalid-feedback").remove();
        $.get(url, data, function (data) {
            if (data.showModelAddPlacePrice == 1) {
                Swal.fire({
                    title: data.title,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: data.cancelButtonText,
                    confirmButtonText: data.confirmButtonText,
                }).then((result) => {
                    if (result.value) {
                        $.get(data.url, { showInModel: true }, function (data) {
                            $(".modal-body").html(data);
                            $("#modal-default").modal("show");
                        });
                    }
                });
            }
            $.each(data, function (key, val) {
                $('[name="shipping[' + key + ']"]').val(val);
            });
        }).fail(function (errors) {
            $.each(errors.responseJSON.errors, function (key, val) {
                $('[name="shipping[' + key + ']"]').addClass("is-invalid");
                $(`[name="shipping[${key}]"]`).after(
                    '<span class="error invalid-feedback">' + val + "</span>"
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
