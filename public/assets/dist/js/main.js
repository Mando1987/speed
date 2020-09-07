
$(document).ready(function () {
    bsCustomFileInput.init();
});

var loadFile = function(event) {
    
    var output = document.getElementById('image-privew');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
};

