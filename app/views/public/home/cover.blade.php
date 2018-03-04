<section id="cover" class="fullsize-video-bg">
    <div class="inner-video-text">
        <article>
            <div class="nav-logo">
            {{ HTML::image('css/assets/images/logo_main.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive cover-logo']) }}
            </div>
            @if($cover_data['cover_title'])
                <h1 class="cover-title">{{ $cover_data['cover_title'] }}</h1>
            @endif
            @if($cover_data['cover_subtitle'])
                <h2 class="cover-subtitle">{{ $cover_data['cover_subtitle'] }}</h2>
            @endif
        </article>
    </div>
    <span class="sc" id="cover-scroller">
        <span></span>
    </span>
    <div id="video-viewport">
        <video width="1280" height="720" autoplay muted loop>
            <source src="{{ url('css/assets/videos/cover_video_main.webm') }}" type="video/webm" />
            <source src="{{ url('css/assets/videos/cover_video_main.mp4') }}" type="video/mp4" />
        </video>
    </div>

    <div class="cover-scroller" id="scroller">
        <a href="#" class="scroll-down"></a>
    </div>
</section>