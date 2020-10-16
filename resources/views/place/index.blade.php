@extends('layouts.dashboard')

@section('content')
<div class="card card-solid">
  <div class="card-header p-1 border-bottom-0">
    <form class="w-100" id="placeIndexForm" action="{{ route('place.index') }}" method="GET">
      <input type="hidden" name="page" value="{{ $cities->currentPage() }}">
      <input type="hidden" name="paginate" value="{{ $cities->perPage() }}">
      <div class="row d-flex align-items-stretch">
        <div class="col-12 col-sm-4 col-md-2  d-flex align-items-stretch mb-1">
          <select class="custom-select custom-select-sm font-weight-bold" name="governorate_id" id="getAllCityForPlace">
            @foreach($governorates as $governorate)
            <option class="font-weight-bold" value="{{ $governorate->id }}" @if($governorate->id == $governorate_id) selected
              @endif>{{ $governorate->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12 col-sm-4 col-md-4">
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
        <div class="col-12 col-md-2">
          <div class="form-group row">
              <div class="col-4 col-sm-4">
                  <x-label title="{{__('site.show_records')}}" />
              </div>
              <div class="col-8 col-sm-8">
                <select class="custom-select custom-select-sm font-weight-bold" name="paginate">
                  @foreach(range(5,50,5) as $number)
                  <option class="font-weight-bold" value="{{ $number }}" @if($number == $cities->perPage()) selected @endif>{{ $number }}</option>
                  @endforeach
                </select>
              </div>
          </div>
      </div>
      </div><!-- end of search row -->
      <div class="row">
        <div class="col-12">
          <div>
            <a href="{{ route('place.create') }}"  class="btn btn-success btn-sm ml-1">
               <span class="d-none d-md-block">
                <i class="fas fa-plus"></i>
                @lang('site.add')
              </span>
              <span class="d-block d-md-none">
                <i class="fas fa-plus"></i>
              </span>
            </a>
            <button type="button" class="btn btn-info btn-sm placeEditMultiCitiesButton disabled" cities_ids="">
              <span class="d-none d-md-block">
                <i class="fas fa-pencil-alt"></i>
                @lang('site.edit')
              </span>
              <span class="d-block d-md-none">
                <i class="fas fa-pencil-alt"></i>
              </span>
            </button>
            <a href="#" class="btn btn-danger btn-sm disabled placeDeleteMultiCitiesButton" onclick="deletedMethod(1)">
              <span class="d-none d-md-block">
                  <i class="far fa-trash-alt"></i>
                  @lang('site.delete')
              </span>
              <span class="d-block d-md-none">
                  <i class="far fa-trash-alt"></i>
              </span>
            </a>


          </div>
        </div>
      </div>
    </form>
    <form id="deletedForm1" action="{{ route('place.destroyMultiCities') }}" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="cities_ids">
    </form>
  </div>
  <!--card-header-->
  @if($cities->count())
  <div class="card-body p-1">
    <form action="{{ route('place.editMultiCites') }}" method="GET">
      <div class="table-responsive p-0">
        <table class="table table-head-fixed table-bordered text-nowrap text-center table-sm">
          <thead>
            <tr>
              <td style="width:25px">
                <div class="icheck-success">
                  <input type="checkbox" value="" id="selectAllPlaces">
                  <label for="selectAllPlaces"></label>
                </div>
              </td>
              <th style="width:35px"> # </th>
              @foreach (trans('datatable.place') as $key =>$val)
              <th>{{ $val }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody class="placeIndex">
            @foreach($cities as $index => $city)
            <tr>
              <td>
                <div class="icheck-success">
                  <input type="checkbox" name="cities_ids[]" value="{{ $city->id }}" id="check{{ $index }}">
                  <label for="check{{ $index }}"></label>
                </div>
              </td>
              <td class="sorting_1" tabindex="0">{{ $cities->firstItem()+$index }}</td>
              <td> {{ $city->governorate->name}} </td>
              <td> {{ $city->name}} </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </form>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <nav aria-label="Contacts Page Navigation">
      <ul class="pagination justify-content-center m-0">
        {{ $cities->appends(['governorate_id'=> $governorate_id , 'search'=> $search , 'paginate' => $cities->perPage()])->links() }}
      </ul>
    </nav>
  </div>
  <!-- /.card-footer -->
  @else
  <div class="m-3">
    <x-empty-records-button-add route="place.create" />
  </div>
  @endif
</div>
@endsection

@push('scripts')
     @include('includes.scripts.delete')
@endpush