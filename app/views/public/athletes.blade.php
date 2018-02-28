@include('public.layout.header')

<section class="main-content">
    <h1 class="main-full-title">{{ $page_title }}</h1>
    <h2 class="main-full-title">Upoznajte naše natjecatelje, od najmlađih do najstarijih.</h2>

    <div id="wrapper-news">
        <div id="main-news-content">
            @if($athletes_data->count() > 0)
                <div class="timeline">
                    @foreach($athletes_data as $inx => $athlete)
                        <div class="timeline-container @if($inx % 2 == 0) left-time @else right-time @endif">
                            <div class="athlete-content">
                                <div class="row">
                                    <div class="col-md-12 athlete-image">
                                        @if($athlete->athlete_profile_image)
                                            <img src="{{ URL::to('/'.getenv('ATHLETES_UPLOAD_DIR').'/'.$athlete->athlete_profile_image) }}" alt="{{ imageAlt($athlete->athlete_profile_image) }}" class="img-responsive img-circle img-real-circle img-center lazy" />
                                        @else
                                            @if($athlete->athlete_gender == 'male')
                                                <img src="{{ url('css/assets/images/athletes/male_athlete_icon.png') }}" alt="Male profile image" class="img-responsive img-circle img-real-circle img-center lazy" />
                                            @else
                                                <img src="{{ url('css/assets/images/athletes/female_athlete_icon.png') }}" alt="Female profile image" class="img-responsive img-circle img-real-circle img-center lazy" />
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <h2 class="athlete-name">{{ $athlete->athlete_full_name }}</h2>
                                        <h4 class="athlete-birth">
                                            @if($athlete->athlete_birth_date != 0) {{ $athlete->getBirthDateFormated() }} @else n/a @endif
                                        </h4>
                                        <blockquote>
                                            {{ removeEmptyP(nl2p((new BBCParser)->parse($athlete->athlete_description))) }}
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h3 class="text-center">Još nismo nikoga otkrili, dođite uskoro!</h3>
            @endif
        </div> <!-- end #main-news-content -->
    </div> <!-- end #wrapper-news -->
</section> <!-- end .main-content -->

@include('public.layout.footer')