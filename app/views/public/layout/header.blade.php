@include('shared-layout.head')

    <!-- scripts -->
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.all.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.1/fullcalendar.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/bootstrap-select.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/modernizr-2.6.2.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/jquery.lazyload.min.js', ['charset' => 'utf-8']) }}
    <!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/respond.min.js', ['charset' => 'utf-8']) }}
    <![endif]-->

    <!-- stylesheets -->
    {{ HTML::style('css/reset.css') }}
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

<header class="cd-header">
    <a href="{{ url(route('home')) }}" class="cd-logo">
        {{ HTML::image('css/assets/images/logo_main.png', getenv('WEB_NAME').' logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive']) }}
    </a>
    <a href="#0" class="cd-3d-nav-trigger">
        <span></span>
    </a>
    <span id="nav-trigger-text">IZBORNIK</span>
</header> <!-- .cd-header -->

<nav class="cd-3d-nav-container">
    <ul class="cd-3d-nav">
        <li class="cd-selected">
            <a href="#0">Dashboard</a>
        </li>

        <li>
            <a href="#0">Projects</a>
        </li>

        <li>
            <a href="#0">Images</a>
        </li>

        <li>
            <a href="#0">Settings</a>
        </li>

        <li>
            <a href="#0">New</a>
        </li>
    </ul> <!-- .cd-3d-nav -->

    <span class="cd-marker color-1"></span>
</nav> <!-- .cd-3d-nav-container -->