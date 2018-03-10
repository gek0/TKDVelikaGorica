<section id="calendar">
    <div class="row space-x3">
        <div class="col-lg-8 col-lg-offset-2 text-center" alt="Kalendar" title="Kalendar">
            <i class="fa fas fa-calendar faa-wrench faa-slow animated fa-fw fa-gig"></i>
            <h2 class="space">Događaji koji su u planu, a i oni koji su iza nas</h2>
        </div>
    </div>
    {{ $calendar->calendar() }}
</section>