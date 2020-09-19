<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dist/dataTablesScripts.js') }}"></script>
<script>
    $(function () {
        var table = $('#dataTableId').DataTable({
            dom : "",
            "lengthMenu": [[-1]],
            "searching": true,
            "ordering": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
            "zeroRecords": "@lang('site.datatable_zero_records')",

        }
        });
        $('#myInput').on( 'keyup', function () {
            table.search( this.value ).draw();
        });
    });
</script>