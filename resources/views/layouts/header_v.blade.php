<header class="page-header">
    <div class="banner_top">
        @include('layouts.menu_h')

        @if((request()->is('/')))
            <div data-label="Example" class="df-example">
                <div id="carouselExample3" class="carousel slide banner_background" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselExample3" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselExample3" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselExample3" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="banner_background" style="background-image: url({{asset('images/banner_2.webp')}});">
                                <div class="container">
                                    <div style="padding-top: 35px;">
                                        <h2 class="banner_title">{{$title_include}}</h2>
                                        <h5 class="banner_subtitle">{{$subtitle_include}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="banner_background" style="background-image: url({{asset('images/banner_2.webp')}});">
                                <div class="container">
                                    <div style="padding-top: 35px;">
                                        <h2 class="banner_title">Título 2</h2>
                                        <h5 class="banner_subtitle">Subtitulo 123</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="banner_background" style="background-image: url({{asset('images/banner_2.webp')}});">
                                <div class="container">
                                    <div style="padding-top: 35px;">
                                        <h2 class="banner_title">Título 3</h2>
                                        <h5 class="banner_subtitle">Subtitulo 123</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample3" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"><i data-feather="chevron-left"></i></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample3" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"><i data-feather="chevron-right"></i></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        @else
            <div class="banner_background" style="background-image: url({{asset($image)}});">
                <div class="banner_slide_content">
                    <div class="container">
                        <div>
                            <h2 class="banner_title">{{$title_include}}</h2>
                            <h5 class="banner_subtitle">{{$subtitle_include}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</header>