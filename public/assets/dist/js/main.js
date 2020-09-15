$(document).ready(function () {
    bsCustomFileInput.init();
    $('[data-mask]').inputmask();

    $('#governorate_id').change(function () {

        var id = $(this).val();
        $('#city_id').html('');
        $.get('/get-cities', {
            governorate_id: id
        }, function (data) {

            $.each(data, function (_index, city) {

                $('#city_id').append($('<option></option>').val(city.id).html(city.name));
            }, 'json');

            if ($('#city_id').attr('data')) {

                $('#city_id').val($('#city_id').attr('data'));
            }
            $('#city_id').removeAttr('data');
        });
    });

    $('#getCitiesPriceSelect').change(function () {
        $('#getCitiesPrice').submit();
    });

});

$('input[name="shipping[weight]"]').on('keyup touchend', function () {
    getOrderChargePrice($(this));
});
$('input[name="shipping[quantity]"]').on('keyup touchend', function () {
    getOrderChargePrice($(this));
});

/*** get order charge price  */
function getOrderChargePrice(obj) {
    if (obj.val().length > 0) {

        var url = '/order/get-order-charge-price';
        var weight = $('input[name="shipping[weight]"]');
        var quantity = $('input[name="shipping[quantity]"]');
        var data = {
            weight: weight.val(),
            quantity: quantity.val()
        };
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        $.get(url, data, function (data) {

            if (data.showModelAddPlacePrice == 1) {
                $('.modal-body').html('');
                $('#modal-default').modal('show');
            }
            $.each(data, function (key, val) {
                $('input[name="shipping[' + key + ']"]').val(val);
            });
        }).fail(function (errors) {
            console.table(errors.responseJSON.errors);
            $.each(errors.responseJSON.errors, function (key, val) {
                $('input[name="shipping[' + key + ']"]').addClass('is-invalid');
                $('input[name="shipping[' + key + ']"]').after('<span class="error invalid-feedback">' + val + '</span>');;
            });
        });
    }

}
/*** get order charge price  */
var loadFile = function (event) {

    var output = document.getElementById('image-privew');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src) // free memory
    }
};
