@include('public.layout.header')

<section class="main-content un-padded-un-marginated">
    <div id="wrapper-news wrapper-extended">
        @include('public.home.cover')

        @include('public.home.latest-news')

        <div class="container-fluid padded">
            @include('public.home.calendar')
        </div>
    </div> <!-- end #wrapper-news -->
</section> <!-- end .main-content -->

@push('custom-scripts')
    {{ $calendar->script() }}
@endpush

@include('public.layout.footer')