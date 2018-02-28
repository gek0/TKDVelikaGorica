@include('admin.layout.header')

<div class="container-fluid">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        {{ Form::open(['url' => route('admin-athletes-editPOST'), 'role' => 'form', 'id' => 'admin-athletes', 'files' => true, 'class' => 'form-element']) }}

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('athlete_full_name', 'Ime i prezime sportaša:') }}
                {{ Form::text('athlete_full_name', $athlete->athlete_full_name, ['class' => 'form-input-control', 'placeholder' => 'Ime i prezime sportaša', 'id' => 'athlete_full_name', 'required' => 'true']) }}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('athlete_profile_image', 'Profilna slika sportaša:') }}
                {{ Form::file('athlete_profile_image', ['class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'athlete_profile_image', 'accept' => 'image/*']) }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('athlete_type', 'Tip osobe:') }}
                <div data-toggle="buttons">
                    <label class="btn btn-default btn-circle btn-lg @if($athlete->athlete_type === 'coach') active @endif">
                        <input type="radio" name="athlete_type" value="coach" @if($athlete->athlete_type === 'coach') checked @endif>Trener <i class="fa fa-user"></i>
                    </label>
                    <label class="btn btn-default btn-circle btn-lg @if($athlete->athlete_type === 'athlete') active @endif">
                        <input type="radio" name="athlete_type" value="athlete" @if($athlete->athlete_type === 'athlete') checked @endif>Sportaš <i class="fa fa-user-o"></i>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('athlete_birth_date', 'Datum rođenja:') }}
                <input id="athlete_birth_date" name="athlete_birth_date" type="date" class="'form-input-control" value="@if($athlete->athlete_birth_date != 0){{ date('Y-m-d', strtotime($athlete->athlete_birth_date)) }}@endif" placeholder="@if($athlete->athlete_birth_date != 0){{ date('Y-m-d', strtotime($athlete->athlete_birth_date)) }}@endif">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('athlete_gender', 'Spol sportaša:') }}
                <div data-toggle="buttons">
                    <label class="btn btn-default btn-circle btn-lg @if($athlete->athlete_gender === 'male') active @endif">
                        <input type="radio" name="athlete_gender" value="male" @if($athlete->athlete_gender === 'male') checked @endif>Muško <i class="fa fa-male male-btn"></i>
                    </label>
                    <label class="btn btn-default btn-circle btn-lg @if($athlete->athlete_gender === 'female') active @endif">
                        <input type="radio" name="athlete_gender" value="female" @if($athlete->athlete_gender === 'female') checked @endif>Žensko <i class="fa fa-female female-btn"></i>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('athlete_trophy', 'Postignuće sportaša:') }}
                <div data-toggle="buttons">
                    <label class="btn btn-default btn-circle btn-lg @if($athlete->athlete_trophy === 'bronze') active @endif">
                        <input type="radio" name="athlete_trophy" value="bronze" @if($athlete->athlete_trophy === 'bronze') checked @endif>Bronca <i class="fa fa-trophy bronze-btn"></i>
                    </label>
                    <label class="btn btn-default btn-circle btn-lg @if($athlete->athlete_trophy === 'silver') active @endif">
                        <input type="radio" name="athlete_trophy" value="silver" @if($athlete->athlete_trophy === 'silver') checked @endif>Srebro <i class="fa fa-trophy silver-btn"></i>
                    </label>
                    <label class="btn btn-default btn-circle btn-lg @if($athlete->athlete_trophy === 'gold') active @endif">
                        <input type="radio" name="athlete_trophy" value="gold" @if($athlete->athlete_trophy === 'gold') checked @endif>Zlato <i class="fa fa-trophy gold-btn"></i>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('athlete_description', 'Opis, postignuća, kontakt informacije:') }}
                {{ Form::textarea('athlete_description', $athlete->athlete_description, ['class' => 'form-input-control', 'placeholder' => 'Opis, postignuća, kontakt informacije', 'id' => 'codeEditor']) }}
            </div>
        </div>

        @if($athlete->athlete_profile_image)
            <div class="col-md-12">
                <div class="form-group">
                    <div class="checkbox checkbox-primary">
                        <span class="button-checkbox">
                            <button type="button" class="btn" data-color="warning">Obrisati postojeću profilnu sliku?</button>
                            <input type="checkbox" class="hidden" autocomplete="off" id="profile_image_delete" name="profile_image_delete" value="1">
                        </span>
                    </div>
                </div>
            </div>
        @endif

        <div class="space text-center">
            {{ Form::hidden('id', $athlete->id) }}
            <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
        </div>
        {{ Form::close() }}

        <hr>
        <div class="space text-left">
            <a href="{{ URL::route('admin-athletes') }}">
                <button class="btn btn-submit">Povratak na listu <i class="fa fa-home"></i></button>
            </a>
        </div>
    </div>
</div>

@include('admin.layout.footer')