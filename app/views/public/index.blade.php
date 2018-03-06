@include('public.layout.header')

<section class="main-content un-padded-un-marginated">
    <div id="wrapper-news wrapper-extended">
        @include('public.home.cover')

        @include('public.home.latest-news')

        @include('public.home.about-us')

        <div class="container-fluid padded">
            @include('public.home.calendar')
        </div>

        @include('public.home.athletes')
    </div> <!-- end #wrapper-news -->
</section> <!-- end .main-content -->

@push('custom-scripts')
    {{ $calendar->script() }}
@endpush

@include('public.layout.footer')