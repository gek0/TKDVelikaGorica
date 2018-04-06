<section id="about-club">
    @if($about_club_data->count() > 0)
        <h2 class="text-center inverted-title incremented-title">{{ $about_club_data->about_title }}</h2>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="space-x2 text-center homepage-location-urls">
                    @if($info_data->owner_contact_address && $info_data->map_lat && $info_data->map_lng)
                        <i class="fa fas fa-map-marker faa-tada animated fa-big"></i>
                        Adresa prve dvorane -
                        <a href="https://www.google.com/maps?ll={{ $info_data->map_lat or '' }},{{ $info_data->map_lng or '' }}&z=13&t=m&hl=en-US&gl=US&mapclient=apiv3" target="_blank">
                            <strong>{{ $info_data->owner_contact_address }}</strong> <i class="fa fas fa-external-link"></i>
                        </a>
                    @endif
                    <br>
                    @if($info_data->owner_contact_address_2 && $info_data->map_2_lat && $info_data->map_2_lng)
                        <i class="fa fas fa-map-marker faa-tada animated fa-big"></i>
                        Adresa druge dvorane -
                        <a href="https://www.google.com/maps?ll={{ $info_data->map_2_lat or '' }},{{ $info_data->map_2_lng or '' }}&z=13&t=m&hl=en-US&gl=US&mapclient=apiv3" target="_blank">
                            <strong>{{ $info_data->owner_contact_address_2 }}</strong> <i class="fa fas fa-external-link"></i>
                        </a>
                    @endif
                </div>
                <blockquote class="about" cite="{{ getenv('WEB_NAME') }}">
                    {{ removeEmptyP(nl2p((new BBCParser)->parse($about_club_data->about_body))) }}
                </blockquote>
            </div>
        </div>
    @else
        <h2 class="text-center inverted-title">Trenutno nemamo više informacija o klubu, navratite uskoro.</h2>
    @endif
</section>