@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <h2 class="text-center">Kreiranje nove galerije slika</h2>

        {{ Form::open(['url' => route('admin-image-galleriesPOST'), 'role' => 'form', 'id' => 'admin-image-gallery', 'files' => true, 'class' => 'form-element']) }}

        <div class="form-group">
            {{ Form::label('name', 'Naslov galerije:') }}
            {{ Form::text('name', null, ['class' => 'form-input-control', 'placeholder' => 'Naslov galerije', 'required' => 'true']) }}
        </div>

        <div class="form-group">
            {{ Form::label('image_gallery_images', 'Slike galerije:') }}
            {{ Form::file('image_gallery_images[]', ['multiple' => true, 'class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'image_gallery_images', 'accept' => 'image/*', 'required' => 'true']) }}
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
        </div>
        {{ Form::close() }}

        @if($image_gallery_data->count() > 0)
            <hr>
            <section id="image_gallery">
                <div class="container-fluid">
                    <div class="row padded text-center">
                        <h2>Galerije slika ({{ $image_gallery_data->count() }})</h2>
                        @foreach($image_gallery_data as $gallery)
                            <div class="col-lg-4 col-sm-4 col-6 small-marg">
                                <div class="framed with-overlay">
                                    @if(count($gallery->images))
                                        <img src="{{ url(getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$gallery->path.'/'.$gallery->images()->first()->file_name) }}" alt="{{ imageAlt($gallery->images()->first()->file_name) }}" style="width:100%">
                                    @else
                                        <img src="{{ asset('css/assets/images/no_image_gallery.png') }}" alt="No image available" style="width:100%">
                                    @endif
                                        <div class="overlay">
                                        <a href="{{ route('admin-image-gallery-view', $gallery->slug) }}" class="overlay-link">
                                            {{ $gallery->name }} <i class="fa fa-search" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @else
            <section id="image_gallery">
                <div class="container-fluid">
                    <div class="row padded text-center">
                        <h3>Trenutno <strong>nema</strong> dodanih galerija slika.</h3>
                    </div>
                </div>
            </section>
        @endif
    </div>
</div>

@include('admin.layout.footer')