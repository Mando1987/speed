/*******************************[ start ready function ]*********** **************************** */
$(document).ready(function () {
    console.log(`token : ${__token}`);
    /**
     * OrderFormSubmit to add new order
     */
    $(document).on("submit", "#customerForm", function (e)
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
                alertBody(responseData.alert);
            },
            error: function (reject) {
                if(reject.status == 422){
                   setErrorsClassToInputsFildes(reject.responseJSON.errors);
                }else{
                    alertBody(reject.responseJSON.alert);
                }
            },
        });
        return false;
    }); // end of OrderFormSubmit

});
/*******************************[ end ready function ]*********** **************************** */
var customerFunctions = {
    validateCustomer: function (responseData) {

    },
    validateCustomerError: function (responseData) {
        setErrorsClassToInputsFildes(responseData.errors);
    },
     serverError: function(responseData){
       alertBody(responseData.alert);
    }
};

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

