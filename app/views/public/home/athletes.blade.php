<section id="athletes">
    @if($team_data->count() > 0)
        <h2 class="text-center inverted-title incremented-title">Upoznajte nas pobliže</h2>
        <h3 class="text-center">Ovo su ljudi zaslužni za postojanje "{{ getenv('WEB_NAME') }}".<br>Naši treneri, članovi uprave te naši sportaši i sportašice.</h3>
        <div class="container">
            <div class="row col-lg-8 col-lg-offset-2">
                @foreach($team_data as $member)
                    <div class="col-md-6 text-center">
                        <div class="team-item">
                            <div class="team-image">
                                @if($member->athlete_trophy)
                                    <span class="pull-left athlete-trophy">
                                        <i class="fa fas fa-trophy faa-tada animated fa-big {{ $member->athlete_trophy }}-btn"></i>
                                    </span>
                                @endif
                                @if($member->athlete_profile_image)
                                    <img src="{{ URL::to('/'.getenv('ATHLETES_UPLOAD_DIR').'/'.$member->athlete_profile_image) }}" alt="{{ imageAlt($member->athlete_profile_image) }}" class="img-responsive img-circle img-real-circle-bigger img-center lazy" />
                                @else
                                    @if($member->athlete_gender == 'male')
                                        <img src="{{ url('css/assets/images/athletes/male_athlete_icon.png') }}" alt="Male profile image" class="img-responsive img-circle img-real-circle-bigger img-center lazy" />
                                    @else
                                        <img src="{{ url('css/assets/images/athletes/female_athlete_icon.png') }}" alt="Female profile image" class="img-responsive img-circle img-real-circle-bigger img-center lazy" />
                                    @endif
                                @endif
                            </div>
                            <div class="team-text">
                                <h3>{{ $member->athlete_full_name }}</h3>
                                <hr>
                                @if($member->athlete_birth_date != 0)
                                    <h5>
                                        <i class="fa fas fa-calendar fa-fw"></i>
                                        {{ $member->getBirthDateFormated() }}
                                    </h5>
                                @else
                                    <h5>
                                        <i class="fa fas fa-calendar fa-fw"></i>
                                        n/a
                                    </h5>
                                @endif
                                {{ removeEmptyP(nl2p((new BBCParser)->parse($member->athlete_description))) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @else
        <h2 class="text-center inverted-title">Još nismo objavili listu članova, no navratite uskoro!</h2>
    @endif
    @if($athletes_count > 0)
        <div class="text-center space-x4">
            <a href="{{ route('athletes') }}" class="btn-main-class-static btn-main-clear-text">
                <i class="fa fas fa-users faa-tada animated fa-fw fa-mid"></i> Naši sportaši i sportašice
            </a>
        </div>
    @endif
</section>