<script>
    $(function(){
        $(document).on('click' , '.showSingleModel' , function(){
         
         $.get(this.href,{} , function(data){
             $('.modal-body').html('');
             $('.modal-body').html(data);
             $('#modal-default').modal('show');
         })
         return false;
        })
    }) ; 
</script>
