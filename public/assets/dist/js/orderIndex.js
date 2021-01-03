/*******************************[ start ready function ]*********** **************************** */
$(document).ready(function () {
    console.log(`token : ${__token}`);

    $(document).on("submit", ".OrderFormSubmit", function (e) {
        e.preventDefault();
        resetErorrClasses(MainForm);
        $.ajax({
            url: "",
            type: "GET",
            data: formdata,
            success: function (responseData) {
                orderFunctions[responseData.target](responseData);
            },
            error: function (reject) {
                orderFunctions[reject.responseJSON.target](reject.responseJSON);
            },
        });
        return false;
    }); // end of OrderFormSubmit

    $(document).on("click", ".showViewSetting", function (e) {
        e.preventDefault();
        $.get(this.href, {}, function (data) {
            alertBody(data);
        });
        return false;
    }); // end of showViewSetting
    $(document).on("click", ".print", function () {
        $.get(this.href, {}, function (data) {
            $("#print").html(data);
            alertBody(data, "90%");
        });
        return false;
    });
});
/*******************************[ end ready function ]*********** **************************** */
var orderFunctions = {
    validateCustomer: function (responseData) {},
};

/**
 * set sweet alert box data and fire it
 */
function alertBody(html, defaultWidth = "32rem") {
    Swal.fire({
        html: html,
        showConfirmButton: false,
        allowOutsideClick: true,
        allowEscapeKey: true,
        width: defaultWidth,
        padding: 0,
        customClass: {
            content: "sweet-alert-content",
        },
    });
}
