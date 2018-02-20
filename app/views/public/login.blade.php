@include('shared-layout.head')

    <!-- scripts -->
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/modernizr-2.6.2.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/jquery.lazyload.min.js', ['charset' => 'utf-8']) }}
    {{ HTML::script('js/pace.min.js', ['charset' => 'utf-8']) }}
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
<body id="admin-color">
<!--[if lt IE 9]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- notifications -->
<div class="notificationOutput" id="outputMsg">
    <div class="notificationTools" id="notifTool">
        <span class="fa fa-times fa-med" id="notificationRemove"></span>
        <span id="notificationTimer"></span>
    </div>
</div>

<section class="logo-placeholder space-x3">
    {{ HTML::image('css/assets/images/logo_main_big.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive']) }}
    <h1 class="main-full-title inverted-title">{{ $page_title }}</h1>
</section>

<div class="row form login-container text-center">
    <div class="col-lg-6 col-lg-offset-3">
        {{ Form::open(['route' => 'loginPOST', 'role' => 'form', 'id' => 'adminLogin', 'class' => 'form-element']) }}
        <div class="form-group">
            {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Korisničko ime', 'id' => 'username', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Lozinka', 'id' => 'password', 'required']) }}
        </div>
        <div class="form-group-login text-center space-x3">
            <div class="checkbox checkbox-primary">
                <span class="button-checkbox">
                    <button type="button" class="btn" data-color="warning">Zapamti me na ovom računalu</button>
                    <input type="checkbox" class="hidden" autocomplete="off" id="remember_me" name="remember_me" checked="checked" value="1">
                </span>
            </div>
        </div>

        <button type="submit" class="button-prim" id="loginSubmit">Prijava <i class="fa fa-sign-in"></i></button>
        {{ Form::close() }}
    </div>
</div>


<!-- scripts -->
<script>
    jQuery(document).ready(function(){
        /**
         * login to administration panel
         */
        $("#adminLogin").submit(function (event) {
            event.preventDefault();

            //disable button click and show loader
            $('button#loginSubmit').addClass('disabled');
            $('#adminLoginLoad').css('visibility', 'visible').fadeIn();

            //get input fields values
            var values = {};
            $.each($(this).serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            var token = $('#adminLogin > input[name="_token"]').val();

            //user output
            var outputMsg = $('#outputMsg');
            var errorMsg = "";

            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                dataType: 'json',
                headers: {'X-CSRF-Token': token},
                data: {_token: token, formData: values},
                success: function (data) {
                    //check status of validation and query
                    if (data.status === 'success') {
                        //enable button click and hide loader
                        $('button#loginSubmit').removeClass('disabled');
                        $('#adminLoginLoad').css('visibility', 'hidden').fadeOut();

                        //redirect to intended page
                        window.location = "<?php echo $intended_url; ?>";
                    }
                    else {
                        errorMsg = '<h3>' + data.errors + '</h3>';
                        outputMsg.append(errorMsg).addClass('warningNotif').slideDown();

                        //timer
                        var numSeconds = 3;
                        function countDown(){
                            numSeconds--;
                            if(numSeconds == 0){
                                clearInterval(timer);
                            }
                            $('#notificationTimer').html(numSeconds);
                        }
                        var timer = setInterval(countDown, 1000);

                        function restoreNotification(){
                            outputMsg.fadeOut(1000, function(){
                                //enable button click and hide loader
                                $('button#loginSubmit').removeClass('disabled');
                                $('#adminLoginLoad').css('visibility', 'hidden').fadeOut();

                                setTimeout(function () {
                                    outputMsg.empty().attr('class', 'notificationOutput');
                                }, 1000);
                            });
                        }

                        //hide notification if user clicked
                        $('#notifTool').click(function(){
                            restoreNotification();
                        });

                        setTimeout(function () {
                            restoreNotification();
                        }, numSeconds * 1000);
                    }
                }
            });

            return false;
        });

    });
</script>
{{ HTML::script('js/jquery.easing.1.3.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/jquery.waypoints.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/jquery.stellar.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/main.js', ['charset' => 'utf-8']) }}

</body>
</html>
