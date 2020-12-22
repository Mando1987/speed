<div class="row">
    <div class="col-md text-center">
        <strong class="badge bg-purple p-md-3 p-2 mb-3">
            {{ $title }}
        </strong>
    </div>
    <div class="col-12">
        <div class="order-progress mx-auto">
            <div class="order-line">
                <div class="progress" style="height: 4px">
                    <div class="progress-bar bg-success" role="progressbar" style="width:{{ $progress }}%"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                @for ($i = 1, $total = $count ?? 3; $i <= $total; $i++)
                    <span
                    class="badge  @if($i == $selected OR $selected > $i - 1) badge-success @else badge-danger @endif rounded-circle">
                       <i class="fas @if($i == $selected OR $selected > $i - 1) fa-check @else fa-times @endif"></i>
                    </span>
                    @endfor
                    {{-- <span class="badge badge-success rounded-circle">
                    <i class="fas fa-check"></i>
                </span>
                <span class="badge badge-danger rounded-circle">
                    <i class="fas fa-times"></i>
                </span> --}}

            </div>
        </div>
    </div>

</div>
