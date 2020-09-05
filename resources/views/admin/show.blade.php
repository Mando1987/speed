
<div class="col">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
      <img src="{{asset('/uploads/images/admins/' . $admin->image) }}" alt="">
        
      <h3 class="profile-username text-center">{{ $admin->fullname }}</h3>

      <p class="text-muted text-center">{{ optional($admin->profile)->phone }}</p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>@lang('site.admin_name')</b> <a class="float-right">{{ $admin->name }}</a>
          </li>
          <li class="list-group-item">
            <b>@lang('site.admin_parent')</b> <a class="float-right">{{ optional($admin->parent)->name }}</a>
          </li>
          <li class="list-group-item">
            <b>@lang('site.admin_role_id')</b> <a class="float-right">{{ $admin->role->name }}</a>
          </li>
          <li class="list-group-item">
            <b>@lang('site.admin_status')</b> <a class="float-right">{{ $admin->getActive() }}</a>
          </li>
          <li class="list-group-item">
            <b>@lang('site.admin_email')</b> <a class="float-right">{{ optional($admin->profile)->email}}</a>
          </li>
          <li class="list-group-item">
            <b>@lang('site.admin_address')</b> <a class="float-right">{{ optional($admin->profile)->address}}</a>
          </li>
          <li class="list-group-item">
            <b>@lang('site.admin_phone')</b> <a class="float-right">{{ optional($admin->profile)->phone}}</a>
          </li>
          <li class="list-group-item">
            <b>@lang('site.admin_country')</b> <a class="float-right">{{ optional($admin->profile)->country}}</a>
          </li>
          <li class="list-group-item">
            <b>@lang('site.admin_city')</b> <a class="float-right">{{ optional($admin->profile)->city}}</a>
          </li>
        </ul> 
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

   
  </div>