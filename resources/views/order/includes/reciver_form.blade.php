<form action="{{ route('order.store') }}" method="POST">
    @csrf
    @method('POST')
    <div class="reciver-info">
        <div class="row">
            <div class="col-md text-center">
                <strong class="badge bg-purple p-md-3 p-2 mb-3">
                    @lang('site.reciver_info_title')
                </strong>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>
                    <span class="text-gray-dark font-weight-normal">
                        @lang('site.reciver_fullname')
                    </span>
                </label>
                <input type="text" name="reciver[fullname]" value="{{ $userData->fullname}}"
                    class="form-control @error('reciver.fullname') is-invalid @enderror" id="fullname"
                    placeholder="@lang('site.fullname_placholder')">
                @error('reciver.fullname')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label>
                    <span class="text-gray-dark font-weight-normal">
                        @lang('site.phone')
                    </span>
                </label>
                <input type="text" name="reciver[phone]" value="{{$userData->phone}}"
                    class="form-control @error('reciver.phone') is-invalid @enderror" id="phone"
                    placeholder="@lang('site.phone_placholder')" data-inputmask="'mask': ['099999999[9][9]']" data-mask=""
                    im-insert="true">
                @error('reciver.phone')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror

            </div>
            <div class="form-group col-md-6">
                <label>
                    <span class="text-gray-dark font-weight-normal">
                        @lang('site.address')
                    </span>
                </label>
                <input type="text" name="reciver[address]" value="{{$userData->address}}"
                    class="form-control @error('reciver.address') is-invalid @enderror" id="address"
                    placeholder="@lang('site.address_placholder')">
                @error('reciver.address')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror

            </div>
            <div class="form-group col-md-6">
                <label>
                    <span class="text-gray-dark font-weight-normal">
                        @lang('site.other_phone')
                    </span>
                </label>
                <input type="text" name="reciver[other_phone]" value="{{$userData->other_phone}}"
                    class="form-control @error('reciver.other_phone') is-invalid @enderror" id="other_phone"
                    placeholder="@lang('site.other_phone_placholder')" data-inputmask="'mask': ['099999999[9][9]']" data-mask=""
                    im-insert="true">
                @error('reciver.other_phone')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror

            </div>
            <div class="form-group col-md-6">
                <label>
                    <span class="text-gray-dark font-weight-normal">
                        @lang('site.governorate')
                    </span>
                </label>
                <select class="custom-select" name="reciver[governorate_id]" id="governorate_id">
                    @foreach($governorates as $governorate)
                    <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>
                    <span class="text-gray-dark font-weight-normal">
                        @lang('site.city')
                    </span>
                </label>
                <select class="custom-select" name="reciver[city_id]" id="city_id" data="{{$userData->city_id}}">
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>
                    <span class="text-gray-dark font-weight-normal">
                        @lang('site.special_marque')
                    </span>
                </label>
                <input type="text" name="reciver[special_marque]" value="{{$userData->special_marque}}"
                    class="form-control @error('reciver.special_marque') is-invalid @enderror" id="special_marque"
                    placeholder="@lang('site.special_marque_placholder')">
                @error('reciver.special_marque')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror

            </div>

            <div class="form-group col-md-6">
                <label>
                    <span class="text-gray-dark font-weight-normal">
                        @lang('site.house_number')
                    </span>
                </label>
                <input type="text" name="reciver[house_number]" value="{{$userData->house_number}}"
                    class="form-control @error('reciver.house_number') is-invalid @enderror" id="house_number"
                    placeholder="@lang('site.house_number_placholder')">
                @error('reciver.house_number')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror

            </div>
            <div class="form-group col-md-6">
                <label>
                    <span class="text-gray-dark font-weight-normal">
                        @lang('site.door_number')
                    </span>
                </label>
                <input type="text" name="reciver[door_number]" value="{{$userData->door_number}}"
                    class="form-control @error('reciver.door_number') is-invalid @enderror" id="door_number"
                    placeholder="@lang('site.door_number_placholder')" data-inputmask="'mask': ['9[9]']" data-mask=""
                    im-insert="true">
                @error('reciver.door_number')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror

            </div>
            <div class="form-group col-md-6">
                <label>
                    <span class="text-gray-dark font-weight-normal">
                        @lang('site.shaka_number')
                    </span>
                </label>
                <input type="text" name="reciver[shaka_number]" value="{{$userData->shaka_number}}"
                    class="form-control @error('reciver.shaka_number') is-invalid @enderror" id="shaka_number"
                    placeholder="@lang('site.shaka_number_placholder')">
                @error('reciver.shaka_number')
                <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <a href="{{ route('order.create' , ['page' => 1]) }}" class="btn btn-outline-secondary">@lang('site.back')</a>
    <button type="submit" class="btn btn-secondary">@lang('site.next')</button>
</form>
