@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">

        <section class="section form-section">
            <article class="data_individual">
                <div class="page-header">
                    <h3>{{ HTML::link(route('admin-news'), 'Lista obavijesti') }} <i class="fa fa-angle-right"></i> Pregled vijesti</h3>
                    <hr>
                    <h2>{{ $news_data->news_title }}</h2>
                </div>
                <div class="data_info">
                    <div class="row">
                        <div class="col-md-4">
                            <span class="fa fa-calendar fa-med" title="Objavljeno"></span>
                            <span class="info-text">
                                <time datetime="{{ $news_data->getDateCreatedFormatedHTML() }}">Objavljeno: <strong>{{ $news_data->getDateCreatedFormated() }}</strong></time>
                            </span>
                        </div>
                        <div class="col-md-4">
                            <span class="fa fa-eye fa-med" title="Broj pregleda"></span>
                            <span class="info-text">Pregleda: <strong>{{ $news_data->num_visited }}</strong></span>
                        </div>
                    </div>
                </div>
                <div class="row padded">
                    <div class="col-md-9">
                        <blockquote>
                            {{ removeEmptyP(nl2p((new BBCParser)->parse($news_data->news_body))) }}
                        </blockquote>
                    </div>
                    <div class="col-md-3">
                        <div class="sidebar-content">
                            <div class="sidebar-header">
                                <span class="fa fa-tags fa-med" title="Tagovi"></span> <span class="info-text">Tagovi vijesti ({{ $news_data->tags->count() }})</span>
                            </div>
                            <div class="sidebar-body">
                                @if($news_data->tags->count() > 0)
                                    <ul class="tags">
                                        @foreach($news_data->tags as $tag)
                                            <li>{{ $tag->tag }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Trenutno nema tagova.</p>
                                @endif
                            </div>
                        </div>
                        <div class="sidebar-content">
                            <div class="sidebar-header">
                                <span class="fa fa-cogs fa-med" title="Alati"></span> <span class="info-text">Admin alati</span>
                            </div>
                            <div class="sidebar-body">
                                <a href="{{ route('admin-news-edit', $news_data->slug) }}">
                                    <button class="btn btn-submit-edit" id="newsEdit">
                                        Izmjeni <i class="fa fa-pencil"></i>
                                    </button>
                                </a>
                                <a href="{{ route('admin-news-delete', $news_data->slug) }}">
                                    <button class="btn btn-submit-delete" id="newsDelete">
                                        Obriši <i class="fa fa-trash"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @if($news_data->images->count() > 0)
                    <hr>
                    <section id="image_gallery">
                        <div class="container-fluid">
                            <div class="row padded text-center">
                                <h2>Galerija slika  <small id="image_gallery_counter">{{ $news_data->images->count() }}</small></h2>
                                @foreach($news_data->images as $img)
                                    <div class="col-lg-4 col-sm-4 col-6 small-marg" id="img-container-{{ $img->id }}">
                                        <a href="{{ URL::to('/'.getenv('NEWS_UPLOAD_DIR').'/'.$news_data->id.'/'.$img->file_name) }}" data-imagelightbox="gallery-images">
                                            <img data-original="{{ URL::to('/'.getenv('NEWS_UPLOAD_DIR').'/'.$news_data->id.'/'.$img->file_name) }}" alt="{{ imageAlt($img->file_name) }}" class="thumbnail img-responsive lazy" />
                                        </a>
                                        <a href="{{ route('admin-news-gallery-image-delete', $img->id) }}">
                                            <button id="{{ $img->id }}" class="btn btn-submit-delete btn-image-delete" title="Brisanje slike {{ $img->file_name }}">
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

            </article> <!-- end article of news_data -->
        </section> <!-- end section -->

    </div>
</div>

<script>
    jQuery(document).ready(function(){
        /**
         * delete news gallery image confirmation
         */
        $("#newsDelete").click(function(event){
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
                            'Vijest je sigurna od brisanja :)',
                            'error'
                    )
                }
            })
        });

        /**
         * delete news gallery image confirmation
         */
        $(".btn-image-delete").click(function(event){
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
                            'Slika je sigurna od brisanja :)',
                            'error'
                    )
                }
            })
        });
    });
</script>

@include('admin.layout.footer')