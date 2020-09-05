<script>
    $(document).on('change' , '.changeActive' , function(){
        var element = $(this);
        var dataUrl = $(this).attr('dataUrl');
        var dataId  = $(this).attr('dataId');
        var icon    = "success";

        $.get(dataUrl , {} , function(data){

            if(data.code == 1){
                $('.changeActiveSpan'+dataId).text(data.text);
            }else{
                icon = "error";
                if (element.is(':checked')){
                    element.prop('checked', false);
                }else{
                    element.prop('checked', true);
                }
            }
            Swal.fire(data.title ,data.message ,icon);
        });

         return false;
    })
</script>