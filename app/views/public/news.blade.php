@include('public.layout.header')

<section class="main-content">
    <h1 class="main-full-title">Obavijesti</h1>

    <div id="wrapper-news">
        <div id="main-news-content">
            @if(count($news_data->all()) > 0)
                @foreach(array_chunk($news_data->all(), 3) as $news)
                    @foreach($news as $item)
                        <article class="post">
                            <header>
                                <div class="title">
                                    <h2>
                                        <a href="{{ route('news-show', $item->slug) }}">{{ $item->news_title }}</a>
                                    </h2>
                                </div>
                                <div class="meta">
                                    <p>
                                        <i class="fa far fa-calendar"></i> Objavljeno:
                                    </p>
                                    <time class="published" datetime="{{ $item->getDateCreatedFormatedHTML() }}">
                                        <strong>{{ $item->getDateCreatedFormatedSimpler() }}</strong>
                                    </time>
                                    <p class="text-center">
                                        <i class="fa fas fa-eye fa-fw"></i> Pregledano:
                                        <strong>
                                            {{ $item->num_visited }}
                                            @if($item->num_visited > 1)
                                                puta
                                            @else
                                                put
                                            @endif
                                        </strong>
                                    </p>
                                </div>
                            </header>
                            <a href="{{ route('news-show', $item->slug) }}" class="image featured non-bordered">
                                @if($item->images->count() > 0)
                                    {{ HTML::image('/'.getenv('NEWS_UPLOAD_DIR').'/'.$item->id.'/'.$item->images->first()->file_name, imageAlt($item->images->first()->file_name), ['class' => 'lazy']) }}
                                @else
                                    {{ HTML::image(asset('css/assets/images/no_image_gallery.png'), 'Nema slike') }}
                                @endif
                            </a>
                            <div class="space bordered-post-content">
                                <p>{{ truncateHTML(removeEmptyP(nl2p((new BBCParser)->parse($item->news_body))), 450) }}</p>
                            </div>
                            <div class="text-center tags-collection space">
                                <ul class="tags">
                                    @foreach($item->tags as $tag)
                                        <li>{{ $tag->slug }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </article>
                    @endforeach
                @endforeach

                <div class="pagination-layout pagination-centered">
                    {{ $news_data->appends(Request::except('stranica'))->links() }}
                </div> <!-- end pagination -->
            @else
                @if(!$news_text_sort)
                    <div class="text-center">
                        <h2>Trenutno nema vijesti s traženim filtrom.</h2>
                    </div>
                @else
                    <div class="text-center">
                        <h2>Trenutno nema vijesti.</h2>
                    </div>
                @endif
            @endif
        </div> <!-- end #main-news-content -->

        <section id="sidebar">
            <section id="intro">
                {{ HTML::image('css/assets/images/logo_main.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive intro-img']) }}
                <header>
                    <p>Sve obavijesti vezane za naš klub i iz svijeta taekwondoa.</p>
                </header>

                <div class="row">
                    {{ Form::open(['url' => route('news-sort'), 'method' => 'GET', 'id' => 'formSort', 'role' => 'form']) }}
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('sort_option', 'Sortiranje vijesti:') }}<br>
                                {{ Form::select('sort_option', ['Vrsta sortiranja...' => $sort_data],
                                        $sort_category, ['class' => 'selectpicker show-tick text-left', 'data-style' => 'btn-submit-delete btn-submit-full', 'title' => 'Vrsta sortiranja...', 'data-size' => '5'])
                                }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('news_text_sort', 'Pretraga po naslovu vijesti:') }}
                                {{ Form::text('news_text_sort', $news_text_sort, ['id' => 'news_text', 'class' => 'form-control', 'placeholder' => 'Naslov vijesti...', 'required']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </section>

            @if($top_news_data->count() > 0)
                <!-- top posts -->
                <section>
                    <h2>Najčitanije vijesti</h2>
                    <div class="mini-posts">
                        @foreach($top_news_data as $item)
                            <article class="mini-post">
                                <header>
                                    <h3 class="text-center">
                                        <a href="{{ route('news-show', $item->slug) }}">{{ $item->news_title }}</a>
                                    </h3>
                                </header>
                                <a href="{{ route('news-show', $item->slug) }}" class="image">
                                    @if($item->images->count() > 0)
                                        {{ HTML::image('/'.getenv('NEWS_UPLOAD_DIR').'/'.$item->id.'/'.$item->images->first()->file_name, imageAlt($item->images->first()->file_name), ['class' => 'lazy']) }}
                                    @else
                                        {{ HTML::image(asset('css/assets/images/no_image_gallery.png'), 'Nema slike') }}
                                    @endif
                                </a>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif
        </section> <!-- end #sidebar -->
    </div> <!-- end #wrapper-news -->
</section> <!-- end .main-content -->

@include('public.layout.footer')