@include('public.layout.header')

<section class="main-content">
    <h2 class="main-full-title">Galerije <i class="fa far fa-chevron-right"></i> {{ Str::limit($gallery_data->name, 40) }}</h2>

    <div id="wrapper-news">
        <div id="main-news-content">
            <section id="photos">
                @foreach($gallery_data->images as $img)
                    <a href="{{ URL::to('/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$gallery_data->path.'/'.$img->file_name) }}" data-imagelightbox="gallery-images">
                        <img data-original="{{ URL::to('/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$gallery_data->path.'/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="img-responsive lazy" />
                    </a>
                @endforeach
            </section>

            <div class="space-x2 text-center">
                <hr>
                <a href="{{ route('galleries') }}">
                    <button class="btn-main-class-static btn-main-clear-text">
                        <i class="fa fa-picture-o fa-fw" aria-hidden="true"></i> Povratak na galerije
                    </button>
                </a>
            </div>
        </div> <!-- end #main-news-content -->
    </div> <!-- end #wrapper-news -->
</section> <!-- end .main-content -->

@include('public.layout.footer')