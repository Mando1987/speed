@extends('layouts.dashboard')
@extends('layouts.dataTable')

@section('button')
  <x-add-button route="admin.create" />
@endsection
@if($admins->count())

@section('thead')
<tr>
    <th> # </th>
    <th> @lang('site.admin_fullname') </th>
    <th> @lang('site.admin_parent')   </th>
    <th> @lang('site.admin_role_id')  </th>
    <th> @lang('site.admin_status')   </th>
    <th> @lang('site.actions')        </th>
</tr>
@endsection

@section('tbody')
@foreach($admins as $index => $admin)
<tr>
    <td class="sorting_1" tabindex="0">{{ $admins->firstItem()+$index }}</td>
    <td> {{ $admin->fullname }} </td>
    <td> {{ optional($admin->parent)->fullname }} </td>
    <td> {{ $admin->role->name }} </td>
    <td>
    <x-enable-button  route="admin.changeActive" id="{{ $admin->id }}" isActive="{{ $admin->is_active }}"  />
        
    </td>
    <td>
        <div class="btn-group btn-group-sm">
            <x-show-button   ability="admin_show"    route="admin.show"    id="{{ $admin->id }}" />
            <x-edit-button   ability="admin_edit"    route="admin.edit"    id="{{ $admin->id }}" />
            <x-delete-button ability="admin_destroy" route="admin.destroy" id="{{ $admin->id }}" />
        </div>
    </td>
</tr>
@endforeach

@endsection

@section('paginate')
{{  $admins->links() }}
@endsection

{{-- extend in all pages --}}
@push('datatable')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/dataTablesScripts.js') }}"></script>
@include('includes.scripts.delete')
@endpush
@else
@section('empty')
    <x-empty-records-button-add route="admin.create"/>
@endsection
@endif
