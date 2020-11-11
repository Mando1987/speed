<div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
    <table class="table table-head-fixed table-bordered text-nowrap text-center table-sm">
        <thead>
            <tr>
                <th> # </th>
                @foreach (trans($table_header_name) as $column =>$val)
                <th>{{trans($table_header_name. '.' . $column)}}</th>
                @endforeach
                <th>@lang('site.actions')</th>
            </tr>
        </thead>
        <tbody>
            {{ $tbody }}
        </tbody>
    </table>
</div>