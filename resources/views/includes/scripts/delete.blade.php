<script>
    function deletedMethod(id) {
        var deletedForm = $('#deletedForm' + id);
        Swal.fire({
            title: "@lang('site.are_you_sure_to_delete')",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor : '#d33',
            cancelButtonText  : "@lang('site.cancel')",
            confirmButtonText : "@lang('site.confirm_delete')"
        }).then((result) => {
            if (result.value) {
                deletedForm.submit();
            }
        });
}
</script>
