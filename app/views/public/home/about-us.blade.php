<section id="about-us">
    @if($about_us_data->count() > 0)
        <h2 class="text-center inverted-title incremented-title">{{ $about_us_data->about_title }}</h2>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <blockquote class="about" cite="{{ getenv('WEB_NAME') }}">
                    {{ removeEmptyP(nl2p((new BBCParser)->parse($about_us_data->about_body))) }}
                </blockquote>
            </div>
        </div>
    @else
        <h2 class="text-center inverted-title">Trenutno nemamo više informacija o nama, navratite uskoro.</h2>
    @endif
</section>