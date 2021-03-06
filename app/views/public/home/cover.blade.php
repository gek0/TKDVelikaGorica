<section id="cover" class="fullsize-video-bg">
    <div class="inner-video-text">
        <article>
            @if($cover_data->cover_logo === 'yes')
                <div class="nav-logo">
                    {{ HTML::image('css/assets/images/logo_main.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive cover-logo']) }}
                    {{ HTML::image('css/assets/images/logo_main_mascote.png', 'Logo maskota', ['title' => getenv('WEB_NAME').' maskota', 'class' => 'img-responsive cover-logo']) }}
                </div>
            @endif
            @if($cover_data->cover_title)
                <h1 class="cover-title linebreaks">{{ $cover_data->cover_title }}</h1>
            @endif
            @if($cover_data->cover_subtitle)
                <h2 class="cover-subtitle linebreaks">{{ $cover_data->cover_subtitle }}</h2>
            @endif
        </article>
    </div>
    <div id="video-viewport">
        @if(!$cover_data->cover_file)
            <video width="1280" height="720" autoplay muted loop>
                <source src="{{ url('css/assets/videos/cover_video_main.webm') }}" type="video/webm" />
            </video>
        @elseif($cover_data->cover_type === 'video')
            <video width="1280" height="720" autoplay muted loop>
                <source src="{{ url('/'.getenv('COVER_UPLOAD_DIR').'/'.$cover_data->cover_file) }}" type="video/webm" />
            </video>
        @else
            {{ HTML::image(url('/'.getenv('COVER_UPLOAD_DIR').'/'.$cover_data->cover_file), 'Cover', ['class' => 'cover-photo-image']) }}
        @endif
    </div>
    @if($cover_data->cover_title)
        <div class="cover-scroller" id="scroller" title="Pomaknite se prema dolje">
            <a href="#" class="scroll-down"></a>
        </div>
    @endif
</section>