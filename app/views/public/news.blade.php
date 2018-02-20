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
                                    <span>Objavljeno: </span>
                                    <time class="published" datetime="{{ $item->getDateCreatedFormatedHTML() }}">
                                        <strong>{{ $item->getDateCreatedFormatedSimpler() }}</strong>
                                    </time>
                                </div>
                            </header>
                            <a href="{{ route('news-show', $item->slug) }}" class="image featured">
                                @if($item->images->count() > 0)
                                    {{ HTML::image('/'.getenv('NEWS_UPLOAD_DIR').'/'.$item->id.'/'.$item->images->first()->file_name, imageAlt($item->images->first()->file_name), ['class' => 'lazy']) }}
                                @else
                                    {{ HTML::image(asset('css/assets/images/no_image_gallery.png'), 'Nema slike') }}
                                @endif
                            </a>
                            <p>{{ Str::limit(removeEmptyP(nl2p((new BBCParser)->parse($item->news_body))), 350) }}</p>
                            <footer>
                                <ul class="actions">
                                    <li><a href="#" class="button big">Continue Reading</a></li>
                                </ul>
                                <ul class="stats">
                                    <li><a href="#">General</a></li>
                                    <li><a href="#" class="icon fa-heart">28</a></li>
                                    <li><a href="#" class="icon fa-comment">128</a></li>
                                </ul>
                            </footer>
                        </article>
                    @endforeach
                @endforeach

                <div class="pagination-layout pagination-centered">
                    {{ $news_data->appends(Request::except('stranica'))->links() }}
                </div> <!-- end pagination -->
            @else
                @if($news_text_sort)
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
                {{ HTML::image('css/assets/images/logo_main.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive']) }}
                <header>
                    <p>Sve obavijesti vezane za naš klub i iz svijeta taekwondoa.</p>
                </header>
            </section>

            <section>
                <div class="mini-posts">

                    <!-- Mini Post -->
                    <article class="mini-post">
                        <header>
                            <h3><a href="#">Vitae sed condimentum</a></h3>
                            <time class="published" datetime="2015-10-20">October 20, 2015</time>
                        </header>
                        <a href="#" class="image"><img src="images/pic04.jpg" alt="" /></a>
                    </article>

                </div>
            </section>
        </section> <!-- end #sidebar -->
    </div> <!-- end #wrapper-news -->
</section> <!-- end .main-content -->

@include('public.layout.footer')