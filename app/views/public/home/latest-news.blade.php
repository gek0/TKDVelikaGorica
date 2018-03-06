<section id="latest-news">
    @if($news_data->count() > 0)
        <h2 class="text-center inverted-title incremented-title">Pogledajte zadnje obavijesti na našemu portalu</h2>
        <div id="news-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($news_data as $idx => $news)
                    <li data-target="#news-carousel" data-slide-to="{{ $idx }}" @if($idx === 0) class="active" @endif></li>
                @endforeach
            </ol>

            <div class="carousel-inner">
                @foreach($news_data as $idx => $news)
                    <div class="item @if($idx === 0) active @endif">
                        <div class="space-x2">
                            <h4 class="carousel-news-title">
                                <a href="{{ route('news-show', $news->slug) }}">{{ $news->news_title }}</a>
                            </h4>
                            <p>{{ truncateHTML(removeEmptyP(nl2p((new BBCParser)->parse($news->news_body))), 450) }}</p>
                            <div class="text-center tags-collection space-x2">
                                <ul class="tags">
                                    @foreach($news->tags as $tag)
                                        <li>{{ $tag->slug }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <a class="left carousel-control" href="#news-carousel" data-slide="prev">
                <i class="fa far fa-chevron-left fa-big-x2 fa-fw"></i>
            </a>
            <a class="right carousel-control" href="#news-carousel" data-slide="next">
                <i class="fa far fa-chevron-right fa-big-x2 fa-fw"></i>
            </a>
        </div>

        <div class="text-center space-x4">
            <a href="{{ route('news') }}" class="btn-main-class-static btn-main-clear-text">
                <i class="fa fas fa-newspaper-o faa-tada animated fa-fw fa-mid"></i> Pregled svih obavijesti
            </a>
        </div>
    @else
        <h2 class="text-center inverted-title">Trenutno nema obavijesti, navratite uskoro.</h2>
    @endif
</section>