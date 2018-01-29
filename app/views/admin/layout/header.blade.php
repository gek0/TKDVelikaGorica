@include('shared-layout.head')

    <!-- scripts -->
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.all.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap-select.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/modernizr-2.6.2.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/jquery.lazyload.min.js', ['charset' => 'utf-8']) }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/respond.min.js', ['charset' => 'utf-8']) }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/admin-main.css') }}
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/queries.css') }}
    {{ HTML::style('wysibb/theme/default/wbbtheme.css') }}
    {{ HTML::style('css/dataTables.bootstrap.min.css') }}
    {{ HTML::style('css/responsive.dataTables.min.css') }}
    {{ HTML::style('css/rowReorder.dataTables.min.css') }}
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.min.css') }}
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
                            {{ HTML::smartRoute_link('/', 'Pregled stranice', '<i class="fa fa-search" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/naslovnica', 'Naslovnica', '<i class="fa fa-home" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/obavijesti', 'Obavijesti', '<i class="fa fa-pencil" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/galerija', 'Galerija', '<i class="fa fa-camera" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/video-galerija', 'Video galerija', '<i class="fa fa-video-camera" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/sportasi', 'Treneri - Sportaši', '<i class="fa fa-trophy" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('admin/korisnici', 'Korisnici', '<i class="fa fa-users" aria-hidden="true"></i>') }}
                            {{ HTML::smartRoute_link('odjava', 'Odjava', '<i class="fa fa-sign-out" aria-hidden="true"></i>') }}
                        </ul>
                    </div>
                </nav>
            </div>
        </div>