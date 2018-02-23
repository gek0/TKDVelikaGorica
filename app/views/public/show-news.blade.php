@include('public.layout.header')

@push('custom-news-vars')
    <!-- content directives start -->
    @if($previous_news)
        <div class="previousContent">
            <a href="{{ URL::to(route('news-show', $previous_news['slug'])) }}" title="{{ $previous_news['news_title'] }}">
                <i class="fa far fa-chevron-left fa-gig"></i>
            </a>
        </div>
    @endif
    @if($next_news)
        <div class="nextContent">
            <a href="{{ URL::to(route('news-show', $next_news['slug'])) }}" title="{{ $next_news['news_title'] }}">
                <i class="fa far fa-chevron-right fa-gig"></i>
            </a>
        </div>
    @endif
    <!-- content directives end -->
@endpush

<section class="main-content">
    <h2 class="main-full-title">Obavijesti <i class="fa far fa-chevron-right"></i> {{ Str::limit($news_data->news_title, 20) }}</h2>

    <div id="wrapper-news">
        <article class="post">
            <header>
                <div class="title">
                    <h1 class="text-center">
                        <span>{{ $news_data->news_title }}</span>
                    </h1>
                </div>
                <div class="meta">
                    <p>
                        <i class="fa far fa-calendar"></i> Objavljeno:
                    </p>
                    <time class="published" datetime="{{ $news_data->getDateCreatedFormatedHTML() }}">
                        <strong>{{ $news_data->getDateCreatedFormatedSimpler() }}</strong>
                    </time>
                    <p class="text-center">
                        <i class="fa fas fa-eye fa-fw"></i> Pregledano:
                        <strong>
                            {{ $news_data->num_visited }}
                            @if($news_data->num_visited > 1)
                                puta
                            @else
                                put
                            @endif
                        </strong>
                    </p>
                </div>
            </header>
            <span class="image featured non-bordered">
                @if($news_data->images->count() > 0)
                    {{ HTML::image('/'.getenv('NEWS_UPLOAD_DIR').'/'.$news_data->id.'/'.$news_data->images->first()->file_name, imageAlt($news_data->images->first()->file_name), ['class' => 'lazy']) }}
                @else
                    {{ HTML::image(asset('css/assets/images/no_image_gallery.png'), 'Nema slike') }}
                @endif
            </span>
            <div class="space bordered-post-content">
                <p>{{ removeEmptyP(nl2p((new BBCParser)->parse($news_data->news_body))) }}</p>
            </div>
            <div class="text-center tags-collection space">
                <ul class="tags">
                    @foreach($news_data->tags as $tag)
                        <li>{{ $tag->slug }}</li>
                    @endforeach
                </ul>
            </div>
            @if($news_data->images->count() > 0)
                <hr>
                <div class="space-x4 gal">
                    @foreach($news_data->images as $img)
                        <a href="{{ URL::to('/'.getenv('NEWS_UPLOAD_DIR').'/'.$news_data->id.'/'.$img->file_name) }}" data-imagelightbox="gallery-images">
                            <img data-original="{{ URL::to('/'.getenv('NEWS_UPLOAD_DIR').'/'.$news_data->id.'/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="img-responsive lazy" />
                        </a>
                    @endforeach
                </div>
            @endif
            <div class="space-x2 text-center">
                <hr>
                <a href="{{ route('news') }}">
                    <button class="btn-main-class-static btn-main-clear-text">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i> Povratak na obavijesti
                    </button>
                </a>
            </div>
        </article>
    </div> <!-- end #wrapper-news -->
</section> <!-- end .main-content -->

@include('public.layout.footer')