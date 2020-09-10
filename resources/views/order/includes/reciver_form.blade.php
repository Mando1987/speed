<form action="{{ route('order.store') }}" method="POST">
    @csrf
    @method('POST')
    <div class="reciver-info">
        <div class="row">
            <div class="col-md-6">
                <strong class="badge badge-danger p-2 mb-2">
                    <i class="far fa-clock"></i>
                    @lang('site.reciver_info_title')
                </strong>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.reciver_fullname')
                        </span>
                    </div>
                    <input type="text" name="reciver[fullname]" value="{{ $reciver['fullname'] }}"
                        class="form-control @error('reciver.fullname') is-invalid @enderror" id="fullname"
                        placeholder="@lang('site.reciver_fullname')">
                    @error('reciver.fullname')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.phone')
                        </span>
                    </div>
                    <input type="text" name="reciver[phone]" value="{{$reciver['phone']}}"
                        class="form-control @error('reciver.phone') is-invalid @enderror" id="phone"
                        placeholder="@lang('site.phone')">
                    @error('reciver.phone')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.other_phone')
                        </span>
                    </div>
                <input type="text" name="reciver[other_phone]" value="{{$reciver['other_phone']}}"
                    class="form-control @error('reciver.other_phone') is-invalid @enderror" id="other_phone"
                    placeholder="@lang('site.other_phone')">
                @error('reciver.other_phone')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.governorate')
                        </span>
                    </div>
                    <select class="custom-select" name="reciver[governorate_id]" id="governorate_id">
                        @foreach($governorates as $governorate)
                        <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.city')
                        </span>
                    </div>
                    <select class="custom-select" name="reciver[city_id]" id="city_id" data="{{$reciver['city_id'] }}">
                        @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md">
                 <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.address')
                        </span>
                    </div>
                <input type="text" name="reciver[address]" value="{{$reciver['address']}}"
                    class="form-control @error('reciver.address') is-invalid @enderror" id="address"
                    placeholder="@lang('site.address')">
                @error('reciver.address')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            </div>
            <div class="form-group col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.special_marque')
                        </span>
                    </div>
                <input type="text" name="reciver[special_marque]" value="{{$reciver['special_marque']}}"
                    class="form-control @error('reciver.special_marque') is-invalid @enderror" id="special_marque"
                    placeholder="@lang('site.special_marque')">
                @error('reciver.special_marque')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md">
                 <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.house_number')
                        </span>
                    </div>
                <input type="text" name="reciver[house_number]" value="{{$reciver['house_number']}}"
                    class="form-control @error('reciver.house_number') is-invalid @enderror" id="house_number"
                    placeholder="@lang('site.house_number')">
                @error('reciver.house_number')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            </div>
            <div class="form-group col-md">
                 <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.door_number')
                        </span>
                    </div>
                <input type="text" name="reciver[door_number]" value="{{$reciver['door_number']}}"
                    class="form-control @error('reciver.door_number') is-invalid @enderror" id="door_number"
                    placeholder="@lang('site.door_number')">
                @error('reciver.door_number')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            </div>
            <div class="form-group col-md">
                 <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="badge bg-info pt-3">
                            @lang('site.shaka_number')
                        </span>
                    </div>
                <input type="text" name="reciver[shaka_number]" value="{{$reciver['shaka_number']}}"
                    class="form-control @error('reciver.shaka_number') is-invalid @enderror" id="shaka_number"
                    placeholder="@lang('site.shaka_number')">
                @error('reciver.shaka_number')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            </div>
        </div>
    </div>
    <a href="{{ route('order.create' , ['page' => 1]) }}" class="btn btn-outline-secondary">@lang('site.back')</a>
    <button type="submit" class="btn btn-secondary">@lang('site.next')</button>
</form>
