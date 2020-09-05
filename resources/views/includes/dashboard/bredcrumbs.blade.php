<section class="content-header d-none d-sm-block">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5>{{ breadcrumbName() }}</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">

                    @foreach(breadcrumb() as $url)
                        <li class="breadcrumb-item {{ $url['class'] }}">

                            @if($loop->last && $loop->index > 0)

                                {{ $url['lang'] }}
                            @else

                                <a
                                    href="{{ $url['route'] }}">{{ $url['lang'] }}</a>
                            @endif
                        </li>
                    @endforeach

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
