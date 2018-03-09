<section id="cover" class="fullsize-video-bg">
    <div class="inner-video-text">
        <article>
            @if($cover_data['cover_logo'] === 'yes')
                <div class="nav-logo">
                    {{ HTML::image('css/assets/images/logo_main.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive cover-logo']) }}
                    {{ HTML::image('css/assets/images/logo_main_mascote.png', 'Logo maskota', ['title' => getenv('WEB_NAME').' maskota', 'class' => 'img-responsive cover-logo']) }}
                </div>
            @endif
            @if($cover_data['cover_title'])
                <h1 class="cover-title">{{ $cover_data['cover_title'] }}</h1>
            @endif
            @if($cover_data['cover_subtitle'])
                <h2 class="cover-subtitle">{{ $cover_data['cover_subtitle'] }}</h2>
            @endif
        </article>
    </div>
    <div id="video-viewport">
        <video width="1280" height="720" autoplay muted loop>
            <source src="{{ url('css/assets/videos/cover_video_main.webm') }}" type="video/webm" />
            <source src="{{ url('css/assets/videos/cover_video_main.mp4') }}" type="video/mp4" />
        </video>
    </div>
    @if($cover_data['cover_title'])
        <div class="cover-scroller" id="scroller" title="Pomaknite se prema dolje">
            <a href="#" class="scroll-down"></a>
        </div>
    @endif
</section>