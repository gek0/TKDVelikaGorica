@include('admin.layout.header')

<div class="container-fluid">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        {{ Form::open(['url' => route('admin-athletesPOST'), 'role' => 'form', 'id' => 'admin-athletes', 'files' => true, 'class' => 'form-element']) }}

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('athlete_full_name', 'Ime i prezime:') }}
                {{ Form::text('athlete_full_name', null, ['class' => 'form-input-control', 'placeholder' => 'Ime i prezime', 'id' => 'athlete_full_name', 'required' => 'true']) }}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('athlete_profile_image', 'Profilna slika:') }}
                {{ Form::file('athlete_profile_image', ['class' => 'file', 'data-show-upload' => false, 'data-show-caption' => true, 'id' => 'athlete_profile_image', 'accept' => 'image/*']) }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('athlete_type', 'Tip osobe:') }}
                <div data-toggle="buttons">
                    <label class="btn btn-default btn-circle btn-lg">
                        <input type="radio" name="athlete_type" value="coach">Trener <i class="fa fa-user"></i>
                    </label>
                    <label class="btn btn-default btn-circle btn-lg active">
                        <input type="radio" name="athlete_type" value="athlete" checked>Sportaš <i class="fa fa-user-o"></i>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('athlete_birth_date', 'Datum rođenja:') }}
                <input id="athlete_birth_date" name="athlete_birth_date" type="date" placeholder="Datum rođenja" class="'form-input-control">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('athlete_gender', 'Spol:') }}
                <div data-toggle="buttons">
                    <label class="btn btn-default btn-circle btn-lg active">
                        <input type="radio" name="athlete_gender" value="male" checked>Muško <i class="fa fa-male male-btn"></i>
                    </label>
                    <label class="btn btn-default btn-circle btn-lg">
                        <input type="radio" name="athlete_gender" value="female">Žensko <i class="fa fa-female female-btn"></i>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('athlete_trophy', 'Najveće sportsko postignuće:') }}
                <div data-toggle="buttons">
                    <label class="btn btn-default btn-circle btn-lg">
                        <input type="radio" name="athlete_trophy" value="bronze">Bronca <i class="fa fa-trophy bronze-btn"></i>
                    </label>
                    <label class="btn btn-default btn-circle btn-lg">
                        <input type="radio" name="athlete_trophy" value="silver">Srebro <i class="fa fa-trophy silver-btn"></i>
                    </label>
                    <label class="btn btn-default btn-circle btn-lg">
                        <input type="radio" name="athlete_trophy" value="gold">Zlato <i class="fa fa-trophy gold-btn"></i>
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('athlete_description', 'Opis, postignuća, kontakt informacije:') }}
                {{ Form::textarea('athlete_description', null, ['class' => 'form-input-control', 'placeholder' => 'Opis, postignuća, kontakt informacije', 'id' => 'codeEditor']) }}
            </div>
        </div>

        <div class="space text-center">
            <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
        </div>
        {{ Form::close() }}

        @if($athletes_data->count() > 0)
            <hr>
            <section id="athletes_gallery">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-responsive table-striped table-hover table-condensed" id="data-table">
                            <thead class="text-center text-bold">
                            <tr>
                                <td>Slika</td>
                                <td>Ime i prezime</td>
                                <td>Tip</td>
                                <td>Spol</td>
                                <td>Datum rođenja</td>
                                <td>Postignuće</td>
                                <td>Opcije</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($athletes_data as $athlete)
                                <tr>
                                    <td>
                                        @if($athlete->athlete_profile_image)
                                            <img src="{{ URL::to('/'.getenv('ATHLETES_UPLOAD_DIR').'/'.$athlete->athlete_profile_image) }}" alt="{{ imageAlt($athlete->athlete_profile_image) }}" class="img-responsive img-circle img-real-circle lazy" />
                                        @else
                                            @if($athlete->athlete_gender == 'male')
                                                <img src="{{ url('css/assets/images/athletes/male_athlete_icon.png') }}" alt="Male profile image" class="img-responsive img-circle img-real-circle lazy" />
                                            @else
                                                <img src="{{ url('css/assets/images/athletes/female_athlete_icon.png') }}" alt="Female profile image" class="img-responsive img-circle img-real-circle lazy" />
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <span>{{ $athlete->athlete_full_name }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($athlete->athlete_type === 'athlete')
                                            <i class="fa fa-user-o" title="Sportaš"></i>
                                        @else
                                            <i class="fa fa-user" title="Trener"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($athlete->athlete_gender === 'male')
                                            <i class="fa fa-male fa-big male-btn" title="Muško"></i>
                                        @else
                                            <i class="fa fa-female fa-big female-btn" title="Žensko"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($athlete->athlete_birth_date != 0)
                                            <span>{{ $athlete->getBirthDateFormated() }}</span>
                                        @else
                                            <span>n/a</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($athlete->athlete_trophy === 'bronze')
                                            <i class="fa fa-trophy fa-big bronze-btn" title="Bronca"></i>
                                        @elseif($athlete->athlete_trophy === 'silver')
                                            <i class="fa fa-trophy fa-big silver-btn" title="Srebro"></i>
                                        @elseif($athlete->athlete_trophy === 'gold')
                                            <i class="fa fa-trophy fa-big gold-btn" title="Zlato"></i>
                                        @else
                                            <span>n/a</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin-athletes-edit', $athlete->id) }}">
                                            <button id="{{ $athlete->id }}" class="btn btn-submit-edit" title="Izmjena sportaša {{ $athlete->athlete_full_name }}">
                                                Izmjeni <i class="fa fa-pencil"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('admin-athletes-delete', $athlete->id) }}">
                                            <button id="{{ $athlete->id }}" class="btn btn-submit-delete" title="Brisanje sportaša {{ $athlete->athlete_full_name }}">
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
            <hr>
            <h3 class="text-center">Trenutno nema dodanih trenera i sportaša.</h3>
        @endif
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        /**
         * delete athlete confirmation
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
                            'Nije obrisano :)',
                            'error'
                    )
                }
            })
        });
    });
</script>

@include('admin.layout.footer')