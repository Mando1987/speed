
$(document).ready(function () {
    bsCustomFileInput.init();

    $('#governorate_id').change(function(){

       var id = $(this).val();
       $('#city_id').html('');
       $.get('/get-cities' , {governorate_id:id} , function(data){

          $.each(data, function (_index , city){

            $('#city_id').append($('<option></option>').val(city.id).html(city.name));
          } , 'json');
       });
    });
});

var loadFile = function(event) {

    var output = document.getElementById('image-privew');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
};

