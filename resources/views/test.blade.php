{{-- @php
    $jobs = range(1,200)
@endphp
@each('admin.test', $jobs, 'job') --}}


@foreach (range(1,200) as $item)
    <div>
        {{ $item }}
    </div>
@endforeach