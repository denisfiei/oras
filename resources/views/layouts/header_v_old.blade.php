<header class="page-header">
    <div class="banner_top">
        <div class="banner_background" style="background-image: url({{asset('images/banner_2.webp')}});">
            <div class="banner_slide_content">
                <div class="container">
                    <h2 class="banner_title">{{$title_include}}</h2>
                    <h5 class="banner_subtitle">{{$subtitle_include}}</h5>
                </div>
            </div>
        </div>
        <div class="buttons_right">
            <div><a href="{{route('vigilancia')}}" class="{{(request()->is('vigilancia')) ? 'active' : ''}} rounded"><span class="right_content"><span class="text">VIGILANCIA GENÓMICA</span> <img src="{{asset('images/botones/vigilancia.png')}}" alt="btn1"></span></a></div>
            <div><a href="#" class="{{(request()->is('red')) ? 'active' : ''}} rounded"><span class="right_content"><span class="text">RED REGIONAL DE VIGILACIA GENÓMICA</span> <img src="{{asset('images/botones/red.png')}}" alt="btn1"></span></a></div>
            <div><a href="{{route('secuenciacion')}}" class="{{(request()->is('secuenciacion')) ? 'active' : ''}} rounded"><span class="right_content"><span class="text">SECUENCIACIÓN GENÓMICA</span> <img src="{{asset('images/botones/genoma.png')}}" alt="btn1"></span></a></div>
            <div><a href="#" class="{{(request()->is('distribucion')) ? 'active' : ''}} rounded"><span class="right_content"><span class="text">DISTRIBUCIÓN DE CASOS POR LAS VOC DELTA - OMICRON</span> <img src="{{asset('images/botones/distribucion.png')}}" alt="btn1"></span></a></div>
        </div>
    </div>
</header>