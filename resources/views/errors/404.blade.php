@extends('layouts.dashboard')

@section('content')
    <!-- /.error-page -->
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning alert-dismissible">
            
                <h5><i class="icon fas fa-exclamation-triangle"></i> @lang('errors.ability_title')!</h5>
                @lang('errors.ability_content')
              </div>
        
        </div>
    </div>
@stop