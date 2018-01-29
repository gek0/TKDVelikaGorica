@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <h2 class="text-center">Galerija slika <i class="fa fa-angle-right" aria-hidden="true"></i> {{ $gallery_data->name }}</h2>

        {{ Form::open(['url' => route('admin-image-gallery-editPOST'), 'role' => 'form', 'id' => 'admin-image-gallery', 'files' => true, 'class' => 'form-element']) }}

        <div class="form-group">
            {{ Form::label('name', 'Naslov galerije:') }}
            {{ Form::text('name', $gallery_data->name, ['class' => 'form-input-control', 'placeholder' => 'Naslov galerije', 'required' => 'true']) }}
        </div>

        <div class="form-group">
            {{ Form::label('image_gallery_images', 'Dodaj slike na stranicu:') }}
            {{ Form::file('image_gallery_images[]', ['multiple' => true, 'class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'image_gallery_images', 'accept' => 'image/*']) }}
        </div>

        <div class="text-center">
            {{ Form::hidden('id', $gallery_data->id) }}
            <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
        </div>
        {{ Form::close() }}

        <div class="space clearfix">
            <span class="pull-left">
            <a href="{{ route('admin-image-galleries') }}">
                <button class="btn btn-submit">Povratak na galerije <i class="fa fa-camera"></i></button>
            </a>
            </span>
            <span class="pull-right">
                <a href="{{ route('admin-image-gallery-delete', $gallery_data->id) }}">
                    <button class="btn btn-submit-delete">Brisanje galerije <i class="fa fa-trash"></i></button>
                </a>
            </span>
        </div>

        @if($gallery_data->images->count())
            <hr>
            <section id="image_gallery">
                <div class="container-fluid">
                    <div class="row padded text-center">
                        <h2>Galerija slika  <small id="image_gallery_counter">{{ $gallery_data->images->count() }}</small></h2>
                        @foreach($gallery_data->images as $img)
                            <div class="col-lg-4 col-sm-4 col-6 small-marg" id="img-container-{{ $img->id }}">
                                <a href="{{ URL::to('/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$gallery_data->path.'/'.$img->file_name) }}" data-imagelightbox="gallery-images">
                                    <img data-original="{{ URL::to('/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$gallery_data->path.'/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="thumbnail img-responsive lazy" />
                                </a>
                                <a href="{{ route('admin-image-gallery-image-delete', $img->id) }}">
                                    <button id="{{ $img->id }}" class="btn btn-submit-delete" title="Brisanje slike {{ $img->file_name }}">
                                        Obriši <i class="fa fa-trash"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="clearfix visible-xs"></div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </div>
</div>

@push('custom-scripts')
<script>
    jQuery(document).ready(function(){
        /**
         * delete gallery image confirmation
         */
        $(".btn-submit-delete").click(function(event){
            event.preventDefault();
            var delete_url_redirect = $(this).parent().attr("href");

            swal({
                title: 'Sigurno to želiš?',
                text: 'Ova radnja je nepovratna.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Da',
                cancelButtonText: 'Ne, odustani!',
                confirmButtonClass: 'btn btn-padded-smaller btn-submit-edit',
                cancelButtonClass: 'btn btn-padded-smaller btn-submit-delete',
                buttonsStyling: true
            }).then(function () {
                window.location.href = delete_url_redirect;
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                            'Odustanak',
                            'Nije obrisano :))',
                            'error'
                    )
                }
            })
        });
    });
</script>
@endpush

@include('admin.layout.footer')