@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <section class="section form-section">
            <div class="page-header">
                <h3>{{ HTML::link(route('admin-news'), 'Lista obavijesti') }} <i class="fa fa-angle-right"></i> Izmjena vijesti</h3>
                <hr>
                <h2>{{ $news_data->news_title }}</h2>
            </div>

            {{ Form::open(['url' => route('admin-news-editPOST', $news_data->slug), 'id' => 'new_news', 'files' => true, 'role' => 'form', 'class' => 'form-element']) }}
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('news_title', 'Naslov vijesti:') }}
                    {{ Form::text('news_title', $news_data->news_title, ['class' => 'form-input-control', 'placeholder' => 'Naslov vijesti', 'id' => 'news_title', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('news_body', 'Tekst vijesti:') }}
                    {{ Form::textarea('news_body', $news_data->news_body, ['class' => 'form-input-control', 'placeholder' => 'Tekst vijesti', 'id' => 'codeEditor']) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('news_images', 'Slike vijesti:') }}
                    {{ Form::file('news_images[]', ['multiple' => true, 'class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'news_images', 'accept' => 'image/*']) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('news_tags', 'Tagovi vijesti: ("Enter" za unos taga)') }}
                    {{ Form::select('tags[]', [], null, ['placeholder' => 'Tagovi vijesti', 'multiple' => 'true', 'id' => 'news_tags', 'data-role' => 'tagsinput']) }}
                </div>

                <button class="btn btn-submit" id="toogle-tags-collection">Lista postojećih tagova <i class="fa fa-chevron-down"></i></button>
                <div class="form-group text-center" id="tags-collection">
                    <ul class="tags">
                        @if($tag_collection->count() > 0)
                            <h4>Klik na tag za odabir:</h4>
                            <ul class="tags">
                                @foreach($tag_collection as $tag)
                                    <li>{{ $tag->tag }}</li>
                                @endforeach
                            </ul>
                        @else
                            <h4>Trenutno nema tagova.</h4>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="space text-center">
                <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
            </div>
            {{ Form::close() }}

            <hr>
            <div class="space text-left">
                <a href="{{ route('admin-news-show', $news_data->slug) }}">
                    <button class="btn btn-submit">Povratak na vijest <i class="fa fa-pencil"></i></button>
                </a>
            </div>
        </section>
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        /**
         *   fill tags input with news tags data if any
         */
        var tagsData = {{ $news_tags }};
        var numOfTags = tagsData.length;
        $('#news_tags').tagsinput('add', '');

        for(var i = 0; i < numOfTags; i++){
            $('#news_tags').tagsinput('add', tagsData[i]);
        }
    });
</script>

@include('admin.layout.footer')