/*******************************[ start ready function ]*********** **************************** */
$(document).ready(function () {
    console.log(`token : ${__token}`);
    /**
     * OrderFormSubmit to add new order
     */
    $(document).on("submit", ".OrderFormSubmit,.FormSubmitAjax", function (e)
    {
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
                orderFunctions[responseData.target](responseData);
            },
            error: function (reject) {
                orderFunctions[reject.responseJSON.target](reject.responseJSON);
            },
        });
        return false;
    }); // end of OrderFormSubmit
    /**
     * set back button in create order
     */
    $(document).on("click", ".createOrderFormBack", function () {
        var paneDiv = $(this).data("pane");
        $(".tab-pane").removeClass("active");
        $("#tab-pane-" + paneDiv).addClass("active");
        return false;
    }); // end of createOrderFormBack
    /**
     * getOrderChargePrice
     */
    var getOrderChargePriceSelectors =
        '[name="shipping[weight]"],[name="shipping[quantity]"],';
    getOrderChargePriceSelectors +=
        '[name="shipping[price]"],[name="shipping[discount]"],';
    getOrderChargePriceSelectors +=
        '[name="shipping[price]"],[name="shipping[discount]"],';
    getOrderChargePriceSelectors += '[name="shipping[charge_on]"]';
    $(getOrderChargePriceSelectors).on("keyup touchend", function () {
        getOrderChargePrice();
    });
    $('[name="shipping[charge_on]"]').on("change", function () {
        getOrderChargePrice();
    }); //end of getOrderChargePrice

});
/*******************************[ end ready function ]*********** **************************** */
var orderFunctions = {
    validateCustomer: function (responseData) {
        toggleTabPaneClass(responseData.data.showClass);
        var reciversSelect = $("#allReciversForCustomer");
        reciversSelect.html("");
        $.each(
            responseData.data.allRecivers,
            function (_index, reciver) {
                reciversSelect.append(
                    $("<option></option>")
                        .val(reciver.id)
                        .html(reciver.fullname)
                );
            },
            "json"
        );
    },
    validateCustomerError: function (responseData) {
        setErrorsClassToInputsFildes(responseData.errors);
    },
    validateReciver: function (responseData) {
        toggleTabPaneClass(responseData.data.showClass);
    },
    validateReciverErrorNew: function (responseData) {
        console.log(responseData.errors);
        $("input[name='reciverType'][value='new']").prop("checked", true);
        setErrorsClassToInputsFildes(responseData.errors);
    },
    validateReciverErrorExists: function (responseData) {
        $("#ReciverNew").click();
        $("#ReciverNew").trigger("change");
        alertBody(responseData.alert);
    },
    validateOrder: function (responseData) {
        console.log(responseData);
        alertBody(responseData.alert);
    },
    validateOrderError: function (responseData) {
        setErrorsClassToInputsFildes(responseData.errors);
    },
     serverError: function(responseData){
       alertBody(responseData.alert);
    },
     validatePlace: function(responseData){
       alertBody(responseData.alert);
    }
};

function toggleTabPaneClass(showClass) {
    $(".tab-pane").removeClass("active");
    $(`#tab-pane-${showClass}`).addClass("active");
}
/**
 * set sweet alert box data and fire it
*/
function alertBody(alert) {
    Swal.fire({
        titleText: alert.title,
        icon: alert.icon,
        html: alert.html,
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
    });
}
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
 * select between new and exists for customer or reciver
 */
$(document).on("change", ".chooseType", function () {
    var name = $(this).attr("name");
    var className = name + $(this).val();
    $("." + name).hide();
    $("." + className).show();
    return false;
});
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

/*** get order charge price  */
function getOrderChargePrice() {
    var url = "/order/get-order-charge-price",
        weight = $('[name="shipping[weight]"]').val(),
        quantity = $('[name="shipping[quantity]"]').val(),
        price = $('[name="shipping[price]"]').val(),
        charge_on = $('[name="shipping[charge_on]"]').val(),
        discount = $('[name="shipping[discount]"]').val();

    var data = {
        shipping: {
            weight: weight,
            quantity: quantity,
            price: price,
            charge_on: charge_on,
            discount: discount,
        }
    };
    if (weight > 0 && quantity > 0) {
        $(".is-invalid").removeClass("is-invalid");
        $(".invalid-feedback").remove();
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': __token},
        });
        $.post(url, data, function (data) {
            console.log(data);
            $.each(data, function (key, val) {
                $('[name="shipping[' + key + ']"]').val(val);
            });
        }).fail(function (reject) {
            console.log(reject);
            var response = $.parseJSON(reject.responseText);
            setErrorsClassToInputsFildes(response.errors);
        });
    }
}
