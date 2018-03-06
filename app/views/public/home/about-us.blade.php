<section id="about-us">
    @if($about_us_data->count() > 0)
        <h2 class="text-center inverted-title incremented-title">Najbitnije što morate znati o nama</h2>

        <blockquote>
            {{ removeEmptyP(nl2p((new BBCParser)->parse($about_us_data['about_body']))) }}
        </blockquote>
    @else
        <h2 class="text-center inverted-title">Trenutno nemamo više informacija o nama, navratite uskoro.</h2>
    @endif
</section>