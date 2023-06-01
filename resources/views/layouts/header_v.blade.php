<header class="page-header">
    <div class="banner_top">
        @include('layouts.menu_h')

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
    </div>
</header>