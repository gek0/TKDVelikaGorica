@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <div id="cover-image">
            {{ Form::open(['url' => route('admin-about-clubPOST'), 'role' => 'form', 'id' => 'about-club', 'class' => 'form-element']) }}
            <div class="form-group">
                {{ Form::label('about_title', 'Naslov sekcije:') }}
                {{ Form::text('about_title', $about_club_data['about_title'], ['class' => 'form-input-control', 'placeholder' => 'Naslov sekcije', 'required' => 'true']) }}
            </div>
            <div class="form-group">
                {{ Form::label('about_body', 'Tekst sekcije:') }}
                {{ Form::textarea('about_body', $about_club_data['about_body'], ['class' => 'form-input-control', 'placeholder' => 'O klubu', 'id' => 'codeEditor']) }}
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@include('admin.layout.footer')