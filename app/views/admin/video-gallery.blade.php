@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        {{ Form::open(['url' => route('admin-video-galleryPOST'), 'role' => 'form', 'id' => 'admin-video-gallery', 'class' => 'form-element']) }}

        <div class="form-group">
            <label for="video_url">YouTube video URL (samo 11 znakova na kraju linka, npr: https://www.youtube.com/watch?v=<span class="red">fNJrtaykBws</span>):</label>
            {{ Form::text('video_url', null, ['class' => 'form-input-control', 'placeholder' => 'Video URL (YouTube)', 'id' => 'video_url', 'maxlength' => 11, 'required' => 'true']) }}
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
        </div>

        {{ Form::close() }}

        @if($video_gallery_data->count() > 0)
            <hr>
            <section id="video_gallery">
                <div class="container-fluid">
                    <div class="row padded text-center">
                        <table class="table table-bordered table-responsive table-striped table-hover table-condensed" id="data-table">
                            <thead class="text-center text-bold">
                            <tr>
                                <td>Video</td>
                                <td>Opcije</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($video_gallery_data as $video)
                                <tr>
                                    <td>
                                        <div class="embed-responsive embed-responsive-16by9 videoWrapper">
                                            <iframe width="650" height="400" src="{{ $video->video_url }}" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </td>
                                    <td >
                                        <a href="{{ route('admin-video-gallery-delete', $video->id) }}" class="space">
                                            <button class="btn btn-submit-delete">
                                                Obriši <i class="fa fa-trash"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        @else
            <section id="video_gallery">
                <div class="container-fluid">
                    <div class="row padded text-center">
                        <h3>Trenutno <strong>nema</strong> dodanih videa u galeriji.</h3>
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
         * delete gallery video confirmation
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
                            'Sigurno od brisanja :)',
                            'error'
                    )
                }
            })
        });
    });
</script>
@endpush

@include('admin.layout.footer')