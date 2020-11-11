<div class="col-12 col-sm-6 col-md-4  d-flex align-items-stretch">
    <div class="card bg-light w-100 card-outline card-{{  $cardColor ?? 'info' }}">
        <div class="card-body pt-0 mb-0 pb-1 p-0">

            <table class="table text-nowrap align-items-stretch table-sm">
                <tbody>
                    {{ $tbody ?? ''}}
                </tbody>
            </table>

            <div class="text-center mt-3 mb-0">
                <div class="btn-group btn-group-sm">
                    {{ $buttons ?? ''}}
                </div>
            </div>

        </div>
    </div><!-- end of card-->
</div>