$(document).ready(function () {
    $(document).on("submit", ".OrderFormSubmit", function (e) {
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
    });

    function resetErorrClasses(MainForm) {
        MainForm.find(".invalid-feedback").each(function () {
            $(this).remove();
        });
        MainForm.find(":input").each(function () {
            $(this).removeClass("is-invalid");
        });
    }
    /**
     * set back button in create order
     */
    $(document).on("click", ".createOrderFormBack", function () {
        var paneDiv = $(this).data("pane");
        $(".tab-pane").removeClass("active");
        $("#tab-pane-" + paneDiv).addClass("active");
        return false;
    });
}); // end of ready function

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
        $("input[name='reciverType'][value='new']").prop('checked', true);
        // $("#ReciverNew").click();
        // $("#ReciverNew").trigger("change");
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
        title: alert.title,
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
    chooseTypeToggle($(this));
});
$(document).on("change", "#ReciverNew", function () {
    chooseTypeToggle($(this));
});

function chooseTypeToggle(input) {
    var name = input.attr("name");
    var className = name + input.val();
    $("." + name).hide();
    $("." + className).show();
    return false;
}
