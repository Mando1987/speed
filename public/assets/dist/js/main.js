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

$('[name="shipping[weight]"],[name="shipping[quantity]"],[name="shipping[price]"],[name="shipping[discount]"]').on('keyup touchend', function () {
    getOrderChargePrice();
});

$('[name="shipping[charge_on]"]').on('change', function(){
    getOrderChargePrice();
});

/*** get order charge price  */
function getOrderChargePrice() {

    var url       = '/order/get-order-charge-price' ,
        weight    = $('[name="shipping[weight]"]') ,
        quantity  = $('[name="shipping[quantity]"]') ,
        price     = $('[name="shipping[price]"]') ,
        charge_on = $('[name="shipping[charge_on]"]');
        discount  = $('[name="shipping[discount]"]');

    var data = {
        weight    : weight.val(),
        quantity  : quantity.val(),
        price     : price.val(),
        charge_on : charge_on.val(),
        discount  : discount.val(),
    };
    if (weight.val() > 0 && quantity.val() > 0) {

        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        $.get(url, data, function (data) {
            // console.table(data);

            if (data.showModelAddPlacePrice == 1) {
                $('.modal-body').html('');
                $('#modal-default').modal('show');
            }
            $.each(data, function (key, val) {
                $('[name="shipping[' + key + ']"]').val(val);
            });
        }).fail(function (errors) {
            // console.table(errors.responseJSON);
            $.each(errors.responseJSON.errors, function (key, val) {
                $('[name="shipping[' + key + ']"]').addClass('is-invalid');
                $(`[name="shipping[${key}]"]`).after('<span class="error invalid-feedback">' + val + '</span>');;
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
