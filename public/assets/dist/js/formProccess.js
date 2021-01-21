$(document).ready(function () {

    $(document).on("submit", "form", function (e)
    {
        e.preventDefault();
        var form = this;
        var formdata = new FormData(form);
        var MainForm = $(this);
        resetErorrClasses(MainForm);
        $.ajax({
            url: form.action,
            type: form.method,
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            success: function (responseData) {
                alertBody(responseData.alert);
            },
            error: function (reject) {
                console.log(reject.responseJSON.errors);
                setErrorsClassToInputsFildes(reject.responseJSON.errors);
            },
        });
        return false;
    }); // end of OrderFormSubmit
});

function resetErorrClasses(MainForm) {
    MainForm.find(".invalid-feedback").each(function () {
        $(this).remove();
    });
    MainForm.find(":input").each(function () {
        $(this).removeClass("is-invalid");
    });
}
function setErrorsClassToInputsFildes(errors) {
    var name = undefined;
    $.each(errors, function (key, val) {
        console.log(key);
        name = `[name=${key}]`;
        //check if key is array
        if (key.indexOf(".") != -1) {
            name = key.split(".");
            endName = '[name="' + name[0];
            for(var i =1,total = name.length; i < total;i++){
              endName += "[" + name[i] + "]";
            }
            endName += '"]';
        }
        $(endName).addClass("is-invalid");
        $(endName).after(
            '<span class="error invalid-feedback">' + val[0] + "</span>"
        );
    });

}

function alertBody(alert) {
    Swal.fire({
        html: alert.html,
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
    });
}
