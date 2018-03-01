<section id="calendar">
    @if($events->count() > 0)
        {{ $calendar->calendar() }}
    @else
        <h3 class="text-center">Trenutno nema događaja zabilježenih na kalendaru.</h3>
    @endif
</section>