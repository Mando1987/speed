<div class="card card-solid">
    <!--card-header-->
    <div class="card-header p-1 border-bottom-0">
        {{$card_header ?? ''}}
    </div>
    <!--card-header-->
    <!--card-body-->
    <div class="card-body p-1">
        <div class="row d-flex align-items-stretch">
            {{ $grid ?? '' }}
        </div>
        <div class="table-responsive p-0">
            {{$no_gird ?? ''}}
        </div>
    </div>
    <!-- /.card-body -->
    <!-- /.card-fotter -->
    <div class="card-footer">
        <nav aria-label="Contacts Page Navigation">
            <ul class="pagination justify-content-center m-0">
                {{$paginate ?? ''}}
            </ul>
        </nav>
    </div>
</div>
<!-- /.card -->