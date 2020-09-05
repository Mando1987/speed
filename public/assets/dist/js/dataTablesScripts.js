$(function () {
    var table = $('#dataTableId').DataTable({
        dom: "",
        "lengthMenu": [
            [-1]
        ],
        "searching": true,
        "ordering": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "zeroRecords": "@lang('site.datatable_zero_records')",

        }
    });
    $('#myInput').on('keyup', function () {
        table.search(this.value).draw();
    });
});
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
});


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