            <footer id="footer" role="contentinfo">
                <div class="container space">
                    <div class="row">
                        <div class="col-md-6 text-center sponsors">
                            <h5 class="inverted-title">Pronađite nas na društvenim mrežama</h5>
                            <ul class="social-icons-nav">
                                @if(get_section_enabled_status('news'))
                                    <li class="social-icon social-rss" alt="RSS" title="RSS">
                                        <a href="{{ route('rss') }}" target="_blank">
                                            <i class="fa fas fa-rss-square fa-gig fa-fw"></i>
                                        </a>
                                    </li>
                                @endif
                                @if($info_data->facebook_url)
                                    <li class="social-icon social-facebook" alt="Facebook" title="Facebook">
                                        <a href="{{ $info_data->facebook_url }}" target="_blank">
                                            <i class="fa fab fa-facebook-square fa-gig fa-fw"></i>
                                        </a>
                                    </li>
                                @endif
                                @if($info_data->twitter_url)
                                    <li class="social-icon social-twitter" alt="Twitter" title="Twitter">
                                        <a href="{{ $info_data->twitter_url }}" target="_blank">
                                            <i class="fa fab fa-twitter-square fa-gig fa-fw"></i>
                                        </a>
                                    </li>
                                @endif
                                @if($info_data->instagram_url)
                                    <li class="social-icon social-instagram" alt="Instagram" title="Instagram">
                                        <a href="{{ $info_data->instagram_url }}" target="_blank">
                                            <i class="fa fab fa-instagram fa-gig fa-fw"></i>
                                        </a>
                                    </li>
                                @endif
                                @if($info_data->youtube_url)
                                    <li class="social-icon social-youtube" alt="YouTube" title="YouTube">
                                        <a href="{{ $info_data->youtube_url }}" target="_blank">
                                            <i class="fa fab fa-youtube-square fa-gig fa-fw"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-md-6 text-center sponsors">
                            <h5 class="inverted-title">Ovim putem se želimo zahvaliti</h5>
                            <a href="http://www.nextgrupa.hr" target="_blank">
                                <img src="{{ asset('sponsors/next-grupa.png') }}" class="img-responsive sponsor-img">
                            </a>
                            <a href="https://shoebedo.com/hr/" target="_blank">
                                <img src="{{ asset('sponsors/shoebedo.png') }}" class="img-responsive sponsor-img">
                            </a>
                        </div>
                    </div>
                    <hr class="faint">
                    <div class="row copyright">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('home') }}">
                                {{ HTML::image('css/assets/images/logo_main_small.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive footer-logo']) }}
                                {{ HTML::image('css/assets/images/logo_main_small_mascote.png', 'Logo maskota', ['title' => getenv('WEB_NAME').' maskota', 'class' => 'img-responsive footer-logo']) }}
                            </a>
                            <p>&copy; <b>{{ getenv('WEB_NAME') }}</b>, {{ date('Y') }}<br>
                                Code &amp; Design made with <i class="fa fa-heart faa-pulse animated red" title="love"></i>  by <a href="{{ url('https://github.com/gek0') }}" target="_blank">MB</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>

            </div> <!-- end #main -->
        </div><!-- wrapper -->
    </div><!-- /container -->

    <nav class="outer-nav left vertical">
        <ul class="nav nav-pills nav-stacked">
            <li class="nav-logo-single">
                {{ HTML::image('css/assets/images/logo_main.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive']) }}
            </li>
            {{ HTML::smartRoute_link_v2('/', 'Početna', '<i class="fa fas fa-home fa-fw" aria-hidden="true"></i>') }}
            @if(get_section_enabled_status('news'))
                {{ HTML::smartRoute_link_v2('obavijesti', 'Obavijesti', '<i class="fa fa-newspaper-o fa-fw" aria-hidden="true"></i>') }}
            @endif
            @if(get_section_enabled_status('athletes'))
                {{ HTML::smartRoute_link_v2('sportasi', 'Sportaši', '<i class="fa fa-users fa-fw" aria-hidden="true"></i>') }}
            @endif
            @if(get_section_enabled_status('galleries'))
                {{ HTML::smartRoute_link_v2('galerije', 'Galerije', '<i class="fa fa-picture-o fa-fw" aria-hidden="true"></i>') }}
            @endif
            @if(get_section_enabled_status('contact'))
                {{ HTML::smartRoute_link_v2('kontakt', 'Kontakt', '<i class="fa fas fa-envelope-open fa-fw" aria-hidden="true"></i>') }}
            @endif
            <li class="nav-logo-single">
                {{ HTML::image('css/assets/images/logo_main_mascote.png', 'Logo', ['title' => getenv('WEB_NAME').' maskota', 'class' => 'img-responsive']) }}
            </li>
        </ul>
    </nav>
</div><!-- /perspective -->

@stack('custom-news-vars')

@if($notification_data['enabled'] === 'yes')
    <div id="global-notification">
        <a href="#" title="{{ $notification_data['title'] }}">
            <i class="fa far fa-bullhorn fa-gig"></i>
        </a>
    </div>
    <script>
        jQuery(document).ready(function(){
            /**
             * show global notification
             */
            $("#global-notification").click(function(event){
                event.preventDefault();
                $(this).addClass('animated tada');
                swal({
                    title: '{{ $notification_data['title'] }}',
                    html: '{{ json_encode(removeEmptyP(nl2p((new BBCParser)->parse($notification_data['body'])))) }}',
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    animation: false,
                    customClass: 'animated bounceIn',
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Hvala',
                    confirmButtonAriaLabel: 'Hvala'
                })
            });
        });
    </script>
@endif

<!-- scripts -->
{{ HTML::script('js/skel.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/classie.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/menu.js', ['charset' => 'utf-8']) }}
{{ HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAq_DC0fNjXxqN-dTvo6PhN_ifxBvBcCWI', ['charset' => 'utf-8']) }}
{{ HTML::script('js/custom-map.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/imagelightbox.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/main.js', ['charset' => 'utf-8']) }}

@stack('custom-scripts')

</body>
</html>
