<!-- Profile Image -->
<div class="card card-primary card-outline">
    <div class="card-body box-profile">

        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{$delegate->getImageProfilePAth()}}">
        </div>
        <h3 class="profile-username text-center">{{ $delegate->fullname }}</h3>

        <p class="text-muted text-center">{{ $delegate->phone }}</p>

        <ul class="list-group list-group-unbordered">
            <li class="list-group-item" >
                <b>@lang('site.fullname')</b> <a class="float-right">{{ $delegate->fullname }}</a>
            </li>
            <li class="list-group-item">
                <b>@lang('site.qualification')</b> <a class="float-right">{{ $delegate->qualification }}</a>
            </li>
            <li class="list-group-item">
                <b>@lang('site.phone')</b> <a class="float-right">{{ $delegate->phone }}</a>
            </li>
            <li class="list-group-item">
                <b>@lang('site.other_phone')</b> <a class="float-right">{{ $delegate->other_phone }}</a>
            </li>
            <li class="list-group-item">
                <b>@lang('site.national_id')</b> <a class="float-right">{{ $delegate->national_id }}</a>
            </li>
            <li class="list-group-item">
                <b>@lang('site.social_status')</b> <a class="float-right">@lang('site.social_status_' .
                    $delegate->social_status)</a>
            </li>
            <li class="list-group-item">
                <b>@lang('site.address')</b> <a class="float-right">{{ $delegate->address }}</a>
            </li>
            <li class="list-group-item">
                <b>@lang('site.governorate')</b> <a class="float-right">{{ $delegate->governorate->name }}</a>
            </li>

            <li class="list-group-item">
                <b>@lang('site.city')</b> <a class="float-right">{{ $delegate->city->name }}</a>
            </li>
            <li class="list-group-item">
                <b>@lang('site.driveType')</b> <a class="float-right">@lang('site.driveType_' .
                    $delegate->delegateDrive->type)</a>
            </li>
            <li class="list-group-item">
                <b>@lang('site.drivePlate_number')</b> <a
                    class="float-right">{{$delegate->delegateDrive->plate_number}}</a>
            </li>
            <li class="list-group-item">
                <b>@lang('site.national_image')</b>
            </li>
            <li class="list-group-item">
              <div class="text-center">
                <img class="img-fluid" src="{{$delegate->getImageNationalPAth()}}">
            </div>
            </li>

        </ul>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
