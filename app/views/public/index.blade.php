@include('public.layout.header')

<section class="main-content un-padded-un-marginated">
    <div id="wrapper-news wrapper-extended">
        @include('public.home.cover')

        @if(get_section_enabled_status('news'))
            @include('public.home.latest-news')
        @endif

        @if(get_section_enabled_status('about-us'))
            @include('public.home.about-us')
        @endif
        <hr>
        @include('public.home.athletes')

        @if(get_section_enabled_status('calendar'))
            <div class="container-fluid padded">
                @include('public.home.calendar')
            </div>
        @endif

        @if(get_section_enabled_status('about-club'))
            @include('public.home.about-club')
        @endif
    </div> <!-- end #wrapper-news -->
</section> <!-- end .main-content -->

@push('custom-scripts')
    {{ $calendar->script() }}
@endpush

@include('public.layout.footer')