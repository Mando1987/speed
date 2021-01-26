/*******************************[ start ready function ]*********** **************************** */
$(document).ready(function () {
    console.log(`token : ${__token}`);

    $(document).on("submit", ".orderIndexForm", function (e) {
        e.preventDefault();
        var form = this;
        var formdata = new FormData(form);
        $.ajax({
            url: form.action,
            type: form.method,
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            success: function (responseData) {
                // console.log(responseData);
                alertBody(responseData.alert.html);
            },
            error: function (reject) {
                //orderFunctions[reject.responseJSON.target](reject.responseJSON);
            },
        });
        return false;
    }); // end of OrderFormSubmit

    $(document).on(
        "click",
        ".showViewSetting,.showEditPanel,.showUpdatePanel,.changeOrderStatus",
        function (e) {
            e.preventDefault();
            $.get(this.href, {}, function (data) {
                alertBody(data);
            });
            return false;
        }
    ); // end of showViewSetting
    $(document).on("click", ".print", function () {
        $.get(this.href, {}, function (data) {
            $("#print").html(data);
            alertBody(data, "90%");
        });
        return false;
    });
    /******************* */
});
/*******************************[ end ready function ]*********** **************************** */
var orderFunctions = {
    validateCustomer: function (responseData) {},
};

/**
 * set sweet alert box data and fire it
 */
// function alertBody(html, defaultWidth = "32rem") {
//     Swal.fire({
//         html: html,
//         showConfirmButton: false,
//         allowOutsideClick: true,
//         allowEscapeKey: true,
//         width: defaultWidth,
//         padding: 0,
//         customClass: {
//             content: "sweet-alert-content",
//         },
//     });
// }
function alertBody(html, defaultWidth = "32rem") {
    let alertModal = $("#alertPanel"),
        alertDaialog = $("#alertPanel .modal-dialog"),
        alertContent = $("#alertPanel .modal-content");
    alertContent.html(html);
    alertModal.modal('show');
}

function deliveryProccess() {
    alert(123);
}
