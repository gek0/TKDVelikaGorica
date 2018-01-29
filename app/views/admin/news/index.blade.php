@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">

    <section class="section-inner">
        <div class="sidebar-content">
            <div class="sidebar-header">
                <span class="fa fa-cogs fa-med" title="Alati"></span> <span class="info-text">Admin alati</span>
            </div>
            <div class="sidebar-body">
                <a href="{{ URL::route('admin-news-add') }}">
                    <button class="btn btn-submit btn-submit-full">
                        <i class="fa fa-pencil"></i> Nova vijest
                    </button>
                </a>
            </div>
        </div>

        @if(count($news_data->all()) > 0)
            <div class="pagination-layout pagination-centered">
                {{ $news_data->appends(Request::except('stranica'))->links() }}
            </div> <!-- end pagination -->

            @foreach(array_chunk($news_data->all(), 3) as $news)
                <div class="row padded">
                    @foreach($news as $item)
                        <div class="col-md-4 news-all-content" id="news-{{ $item->id }}">
                            <div class="news-all-header">
                                <h3 class="news-all-header-title text-center">{{ $item->news_title }}</h3>
                                @if($item->images->count() > 0)
                                    {{ HTML::image('/'.getenv('NEWS_UPLOAD_DIR').'/'.$item->id.'/'.$item->images->first()->file_name, imageAlt($item->images->first()->file_name), ['class' => 'thumbnail img-responsive lazy']) }}
                                @else
                                    {{ HTML::image(URL::to('https://via.placeholder.com/500x500?text=Nema slike'), 'Nema slike', ['class' => 'thumbnail img-responsive']) }}
                                @endif
                            </div> <!-- end news-all-header -->
                            <hr>
                            <div class="data_info">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <i class="fa fa-calendar" alt="Objavljeno" title="Objavljeno"></i>
                                        <time datetime="{{ $item->getDateCreatedFormatedHTML() }}">Objavljeno:<br><strong>{{ $item->getDateCreatedFormated() }}</strong></time>
                                    </div>
                                </div>
                            </div> <!-- end news info -->
                            <div class="space"></div>
                            <div class="news-all-tools text-center">
                                <a href="{{ route('admin-news-show', $item->slug) }}">
                                    <button class="btn btn-submit">
                                        Pregledaj <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="pagination-layout pagination-centered">
                {{ $news_data->appends(Request::except('stranica'))->links() }}
            </div> <!-- end pagination -->
        @else
            <div class="text-center">
                <h2>Trenutno nema vijesti.</h2>
            </div>
        @endif

    </section> <!-- end section-inner -->
    </div>
</div>

@include('admin.layout.footer')