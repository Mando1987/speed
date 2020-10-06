@extends('layouts.dashboard')

@section('content')
<div class="card card-solid">
  <div class="card-header p-1 border-bottom-0">
    <form class="w-100" id="customer" action="{{ route('customer.index') }}" method="GET">
      <div class="row d-flex align-items-stretch">
        <div class="col-12 col-sm-5 col-md-5  d-flex align-items-stretch mb-1">
          <select class="custom-select custom-select-sm" id="customer_type" name="customer_type">

            <option value="registered" @if($customer_type == 'registered') selected @endif>
              @lang('site.customer_type_registered')
            </option>
            <option value="unRegistered" @if($customer_type == 'unRegistered') selected @endif>
              @lang('site.customer_type_unRegistered')
            </option>


          </select>
        </div>
        <div class="col-8 col-sm-5 col-md-5">
          <div class="input-group input-group-sm">
            <input type="text" name="search" value="" placeholder="@lang('site.search_placeholder')"
              class="form-control">
            <span class="input-group-append">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
              </button>
            </span>
          </div>
        </div>
        <div class="col-4 col-sm-2 col-md-2">
          <div class="float-right">
            <a href="{{ route('customer.index' , ['view' => 'list' ,'customer_type'=>$customer_type??'registered' , 'search'=> $search]) }}"
              class="btn btn-sm @if($view =='list') btn-primary @endif">
              <i class="fas fa-bars"></i>
            </a>
            <a href="{{ route('customer.index' , ['view' => 'grid' ,'customer_type'=>$customer_type??'registered' , 'search'=> $search]) }}"
              class="btn btn-sm @if($view =='grid') btn-primary @endif">
              <i class="fas fa-th"></i>
            </a>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!--card-header-->
  @if($customers->count())
  <div class="card-body p-1">
    @if($view =='grid')
    <div class="row d-flex align-items-stretch">
      @foreach($customers as $index => $customer)
      <div class="col-12 col-sm-6 col-md-4  d-flex align-items-stretch">
        <div class="card bg-light w-100 card-outline card-{{ __('site.color_' . $customer_type) }}">
          <div class="card-body pt-0 mb-0 pb-1 p-0">
            <table class="table text-nowrap align-items-stretch table-sm">
              <tbody>
                <tr>
                  <td>@lang('datatable.customer.manager.fullname')</td>
                  <td>
                    <strong>
                      {{ $customer->fullname }}
                    </strong>
                  </td>
                </tr>
                <tr>
                  <td>@lang('datatable.customer.manager.phone')</td>
                  <td>
                    <strong>
                      {{ $customer->phone }}
                    </strong>
                  </td>
                </tr>
                <tr>
                  <td>@lang('datatable.customer.manager.city')</td>
                  <td>
                    <strong>
                      {{ $customer->city['name']}}
                    </strong>
                  </td>
                </tr>
                <tr>
                  <td>@lang('datatable.customer.manager.address')</td>
                  <td>
                    <strong>
                      {{ $customer->address}}
                    </strong>
                  </td>
                </tr>

              </tbody>
            </table>
            <div class="text-center mt-3 mb-0">
              <div class="btn-group btn-group-sm">
                <x-show-button ability="admin_show" route="customer.show" id="{{ $customer->id  }}" />
                @if($customer->status == 'under_review ' || $customer->status == 'under_preparation')
                <a class="btn btn-info btn-sm mr-2" href="{{ route('order.edit' , $customer->id) }}">
                  <span class="d-none d-md-block">
                    <i class="fas fa-pencil-alt"></i>
                    @lang('site.edit')
                  </span>
                  <span class="d-block d-md-none"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <button class="btn btn-danger btn-sm" onclick="deletedMethod({{ $customer->id }})">
                  <span class="d-none d-md-block">
                    <i class="far fa-trash-alt"></i>
                    @lang('site.delete')
                  </span>
                  <span class="d-block d-md-none">
                    <i class="far fa-trash-alt"></i>
                  </span>
                </button>
                <form id="deletedForm{{ $customer->id }}" action="{{ route('order.destroy', $customer->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                </form>
                @else
                <a class="btn btn-info btn-sm mr-2 disabled" href="#">
                  <span class="d-none d-md-block">
                    <i class="fas fa-pencil-alt"></i>
                    @lang('site.edit')
                  </span>
                  <span class="d-block d-md-none"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <button class="btn btn-danger btn-sm disabled">
                  <span class="d-none d-md-block">
                    <i class="far fa-trash-alt"></i>
                    @lang('site.delete')
                  </span>
                  <span class="d-block d-md-none">
                    <i class="far fa-trash-alt"></i>
                  </span>
                </button>
                @endif
                <a href="" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
              </div>
            </div>
          </div>
        </div><!-- end of card-->
      </div>
      @endforeach
    </div>
    @else
    <div class="table-responsive p-0">
      <table class="table table-head-fixed table-bordered text-nowrap text-center table-sm">
        <thead>
          <tr>
            <th> # </th>
            @foreach (trans('datatable.customer.manager') as $column =>$val)
            <th>{{trans('datatable.customer.manager.' . $column)}}</th>
            @endforeach
            <th>@lang('site.actions')</th>
          </tr>
        </thead>
        <tbody>
          @foreach($customers as $index => $customer)
          <tr>
            <td class="sorting_1" tabindex="0">{{ $customers->firstItem()+$index }}</td>
            <td> {{ $customer->fullname}} </td>
            <td> {{ $customer->phone }} </td>
            <td> {{ $customer->city['name'] }} </td>
            <td> {{ $customer->address }} </td>
            <td> {{ $customer->company_name }} </td>
            <td> {{ $customer->activity }} </td>
            <td></td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <nav aria-label="Contacts Page Navigation">
      <ul class="pagination justify-content-center m-0">
        {{ $customers->appends(['view' => $view ,'customer_type'=>$customer_type??'registered' , 'search'=> $search])->links() }}
      </ul>
    </nav>
  </div>
  <!-- /.card-footer -->
  @else
  <div class="m-3">
    <x-empty-records-button-add route="order.create" />
  </div>
  @endif
</div>
@endsection