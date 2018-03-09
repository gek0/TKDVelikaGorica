@include('shared-layout.head')

    <!-- scripts -->
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment-with-locales.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.all.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap-select.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/modernizr-2.6.2.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/jquery.lazyload.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/pace.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/locale/hr.js', ['charset' => 'utf-8']) }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/respond.min.js', ['charset' => 'utf-8']) }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/normalize.css') }}
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.min.css') }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.1/fullcalendar.min.css') }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.1/fullcalendar.print.css', ['media' => 'print']) }}
    {{ HTML::style('css/main.css') }}
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/queries.css') }}
</head>
<body>

@include('shared-layout.browser-fb')

<a href="#" id="return-to-top" title="Povratak na vrh"><i class="fa far fa-chevron-up"></i></a>

<div id="perspective" class="perspective effect-airbnb">
    <nav class="hidden-scroller">
        <h2 class="text-center inverted-title">{{ getenv('WEB_NAME') }}</h2>
        <ul class="nav nav-pills nav-justified nav-scroller">
            {{ HTML::smartRoute_link_v2('/', 'Početna', '<i class="fa fas fa-home fa-fw" aria-hidden="true"></i>') }}
            {{ HTML::smartRoute_link_v2('obavijesti', 'Obavijesti', '<i class="fa fa-newspaper-o fa-fw" aria-hidden="true"></i>') }}
            {{ HTML::smartRoute_link_v2('sportasi', 'Sportaši', '<i class="fa fa-users fa-fw" aria-hidden="true"></i>') }}
            {{ HTML::smartRoute_link_v2('galerije', 'Galerije', '<i class="fa fa-picture-o fa-fw" aria-hidden="true"></i>') }}
            {{ HTML::smartRoute_link_v2('kontakt', 'Kontakt', '<i class="fa fas fa-envelope-open fa-fw" aria-hidden="true"></i>') }}
        </ul>
    </nav>
    <div class="container-wrapped">
        <div class="wrapper">
            <button class="pulse-button" id="showMenu" title="Prikaži izbornik"></button>
            <div id="main">