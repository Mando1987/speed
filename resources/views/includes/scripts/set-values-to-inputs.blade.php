@push('scripts')
<script>
    $(function () {
            var data = @json($userData);
            var city_id = @json($city_id ?? 0);
            $.each(data, function (parentKey, array) {
                $.each(array, function (key, val) {
                    $('[name="' + parentKey + '[' + key + ']"]').val(val);
                });
            });
            if(city_id !=0){
                $('#city_id').attr('dataVal', city_id);
                $('#governorate_id').trigger('change');
            }
        });
</script>
@endpush