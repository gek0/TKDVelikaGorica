<section id="cover" class="fullsize-video-bg">
    <div class="inner-video-text">
        <div>
            @if($cover_data['cover_title'])
                <h1 class="to-animate">{{ $cover_data['cover_title'] }}</h1>
            @endif
            @if($cover_data['cover_subtitle'])
                <h2 class="to-animate">{{ $cover_data['cover_subtitle'] }}</h2>
            @endif
        </div>
    </div>
    <div id="video-viewport">
        <video width="1280" height="720" autoplay muted loop>
            <source src="{{ url('css/assets/videos/cover_video_main.mp4') }}" type="video/mp4" />
            <source src="{{ url('css/assets/videos/cover_video_main.webm') }}" type="video/webm" />
        </video>
    </div>
</section>