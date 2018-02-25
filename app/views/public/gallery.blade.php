@include('public.layout.header')

<section class="main-content">
    <h1 class="main-full-title">{{ $page_title }}</h1>

    <div id="wrapper-news">
        <div id="main-news-content">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#images">
                        <i class="fa fas fa-picture-o fa-fw" aria-hidden="true"></i> Galerije slika
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#videos">
                        <i class="fa fas fa-play fa-fw" aria-hidden="true"></i> Video galerija
                    </a>
                </li>
            </ul>

            <div class="tab-content gallery-content">
                <div id="images" class="tab-pane fade in active">
                    @if($image_galleries_data->count() > 0)
                        <section id="image_gallery">
                            <div class="container-fluid">
                                <div class="row padded text-center">
                                    <h2>Galerije slika ({{ $image_galleries_data->count() }})</h2>
                                    @foreach($image_galleries_data as $gallery)
                                        <div class="col-lg-4 col-sm-4 col-6 small-marg gallery-cont">
                                            <div class="framed with-overlay">
                                                @if(count($gallery->images))
                                                    <img src="{{ url(getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$gallery->path.'/'.$gallery->images()->first()->file_name) }}" alt="{{ imageAlt($gallery->images()->first()->file_name) }}" style="width:100%">
                                                    <div class="overlay">
                                                        <a href="{{ route('image-gallery-view', $gallery->slug) }}" class="overlay-link">
                                                            {{ $gallery->name }} <i class="fa fa-search" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <img src="{{ asset('css/assets/images/no_image_gallery.png') }}" alt="Nema slike" style="width:100%">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @else
                        <h2 class="text-center">Zasad nije dodana niti jedna galerija slika, svratite uskoro!</h2>
                    @endif
                </div>
                <div id="videos" class="tab-pane fade">
                    @if($video_data->count() > 0)
                        <div class="row">
                            @foreach($video_data as $video)
                                <div class="col-sm-4">
                                    <div class="embed-responsive embed-responsive-16by9 videoWrapper">
                                        <iframe width="650" height="400" src="{{ $video->video_url }}" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h2 class="text-center">Zasad niti jedan video nije dodan u galeriju, svratite uskoro!</h2>
                    @endif
                </div>
            </div>
        </div> <!-- end #main-news-content -->
    </div> <!-- end #wrapper-news -->
</section> <!-- end .main-content -->

@include('public.layout.footer')