@include('shared-layout.head')

    <!-- scripts -->
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.all.min.js', ['charset' => 'utf-8']) }}
    {{-- HTML::script('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.1/fullcalendar.min.js', ['charset' => 'utf-8']) --}}
    {{ HTML::script('js/pace.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap-select.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/modernizr.custom.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/jquery.lazyload.min.js', ['charset' => 'utf-8']) }}
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
    <div class="container-wrapped">
        <div class="wrapper">
            <button class="pulse-button" id="showMenu" title="Prikaži izbornik"></button>
            <div id="main">