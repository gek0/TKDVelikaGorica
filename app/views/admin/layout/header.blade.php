@include('shared-layout.head')

    <!-- scripts -->
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment-with-locales.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.all.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap-select.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/modernizr-2.6.2.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/jquery.lazyload.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/locale/hr.js', ['charset' => 'utf-8']) }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/respond.min.js', ['charset' => 'utf-8']) }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/reset.css') }}
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.min.css') }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.css') }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.print.css', ['media' => 'print']) }}
    {{ HTML::style('wysibb/theme/default/wbbtheme.css') }}
    {{ HTML::style('css/dataTables.bootstrap.min.css') }}
    {{ HTML::style('css/responsive.dataTables.min.css') }}
    {{ HTML::style('css/rowReorder.dataTables.min.css') }}
    {{ HTML::style('css/admin-main.css') }}
    {{ HTML::style('css/queries.css') }}
</head>
<body>

@include('shared-layout.browser-fb')

<!-- notifications -->
<div class="notificationOutput" id="outputMsg">
    <div class="notificationTools" id="notifTool">
        <span class="fa fa-times fa-med" id="notificationRemove"></span>
        <span id="notificationTimer"></span>
    </div>
</div>

<a href="#" id="back-to-top" title="Povratak na vrh">&uarr;</a>

<section id="content-main">
    <div class="container-fluid">

        <div class="space-x3"></div>
        <section class="logo-placeholder">
            {{ HTML::image('css/assets/images/logo_main.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive']) }}
            <h1>{{ $page_title }}</h1>
        </section>

        <!-- Navigation -->
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav">
                            {{ HTML::smartRoute_link('/', 'Pregled stranice', '<i class="fa fas fa-search" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/naslovnica', 'Naslovnica', '<i class="fa fas fa-home" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/o-nama', 'O nama', '<i class="fa fas fa-info" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/o-klubu', 'O klubu', '<i class="fa fas fa-info-circle" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/obavijesti', 'Obavijesti', '<i class="fa fas fa-pencil" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/kalendar', 'Kalendar', '<i class="fa fas fa-calendar" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/galerija', 'Galerija', '<i class="fa fas fa-camera" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/video-galerija', 'Video galerija', '<i class="fa fas fa-video-camera" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/sportasi', 'Treneri - Sportaši', '<i class="fa fas fa-trophy" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/info', 'Info', '<i class="fa fas fa-info" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/sections', 'Sekcije', '<i class="fa fas fa-puzzle-piece" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/korisnici', 'Korisnici', '<i class="fa fas fa-users" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('odjava', 'Odjava', '<i class="fa fas fa-sign-out" aria-hidden="true"></i>') }}
                        </ul>
                    </div>
                </nav>
            </div>
        </div>