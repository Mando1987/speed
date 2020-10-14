<div class="btn-group btn-group-sm">
    @can('order_show')
    <a class="btn btn-primary btn-sm mr-2 showSingleModel" href="{{ route('order.show' ,$order->id) }}">
        <span class="d-none d-md-block">
            <i class="fas fa-eye"></i>
            {{-- @lang('site.show') --}}
        </span>
        <span class="d-block d-md-none"><i class="fas fa-eye"></i></span>
    </a>
    @else
    <a class="btn btn-primary btn-sm mr-2 disabled" href="">
        <span class="d-none d-md-block">
            <i class="fas fa-eye"></i>
            @lang('site.show')
        </span>
        <span class="d-block d-md-none"><i class="fas fa-eye"></i></span>
    </a>
    @endcan


    @if($order->status == 'under_review ' || $order->status == 'under_preparation')
    <a class="btn btn-info btn-sm mr-2" href="{{ route('order.edit' , $order->id) }}">
        <span class="d-none d-md-block">
            <i class="fas fa-pencil-alt"></i>
            {{-- @lang('site.edit') --}}
        </span>
        <span class="d-block d-md-none"><i class="fas fa-pencil-alt"></i></span>
    </a>

    <button class="btn btn-danger btn-sm" onclick="deletedMethod({{ $order->id }})">
        <span class="d-none d-md-block">
            <i class="far fa-trash-alt"></i>
            {{-- @lang('site.delete') --}}
        </span>
        <span class="d-block d-md-none">
            <i class="far fa-trash-alt"></i>
        </span>
    </button>

    <form id="deletedForm{{ $order->id }}" action="{{ route('order.destroy', $order->id) }}" method="POST">
        @csrf
        @method('DELETE')
    </form>

    @else
    <a class="btn btn-info btn-sm mr-2 disabled" href="#">
        <span class="d-none d-md-block">
            <i class="fas fa-pencil-alt"></i>
            {{-- @lang('site.edit') --}}
        </span>
        <span class="d-block d-md-none"><i class="fas fa-pencil-alt"></i></span>
    </a>
    <button class="btn btn-danger btn-sm disabled">
        <span class="d-none d-md-block">
            <i class="far fa-trash-alt"></i>
            {{-- @lang('site.delete') --}}
        </span>
        <span class="d-block d-md-none">
            <i class="far fa-trash-alt"></i>
        </span>
    </button>
    @endif

    <a href="{{ route('order.print' ,['orderId' =>$order->id]) }}" class="print btn btn-default ml-1">
        <i class="fas fa-print"></i>
        {{-- @lang('site.print') --}}
    </a>
</div>