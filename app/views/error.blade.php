@include('shared-layout.head')

   <!-- scripts -->
{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/bootstrap.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/bootstrap-select.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/modernizr-2.6.2.min.js', ['charset' => 'utf-8']) }}
    <!--[if lt IE 9]>
{{ HTML::script('js/html5shiv.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/respond.min.js', ['charset' => 'utf-8']) }}
<![endif]-->

<!-- stylesheets -->
{{ HTML::style('css/bootstrap.min.css') }}
{{ HTML::style('css/main.css') }}
{{ HTML::style('css/style.css') }}
{{ HTML::style('css/queries.css') }}
</head>
<body>
    <div class="container content-holder content-error">
        <div class="space-x3"></div>
        <section class="logo-placeholder">
            {{ HTML::image('css/assets/images/logo_main.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive']) }}
            <h1>Dogodila se greška<br>404</h1>
        </section>

        <section class="section section-inner">
            <div class="text-center space">
                <h2>{{ $exception }}</h2>

                <div class="space"></div>
                <a href="{{ URL::route('home') }}">
                    <button class="btn btn-submit btn-submit-full">
                        <i class="fa fa-home fa-med"></i> Povratak na početnu
                    </button>
                </a>
            </div>
        </section> <!-- end section-inner -->
    </div>
</body>
</html>