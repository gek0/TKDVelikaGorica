            <footer id="footer" role="contentinfo">
                <div class="container">
                    <div class="copyright">
                        <div class="col-md-12 text-center">
                            <p>&copy; <b>{{ getenv('WEB_NAME') }}</b>, {{ date('Y') }} | Made with <i class="fa fa-heart pulseAnim red" title="love"></i>  by <a href="{{ url('https://github.com/gek0') }}" target="_blank">Matija</a></p>
                        </div>
                    </div>
                    <div class="row">
                        ...
                    </div>
                </div>
            </footer>

            </div> <!-- end #main -->
        </div><!-- wrapper -->
    </div><!-- /container -->

    <nav class="outer-nav left vertical">
        <ul class="nav nav-pills nav-stacked">
            <li class="nav-logo">
                {{ HTML::image('css/assets/images/logo_main.png', 'Logo', ['title' => getenv('WEB_NAME'), 'class' => 'img-responsive']) }}
            </li>
            {{ HTML::smartRoute_link_v2('/', 'Početna', '<i class="fa fas fa-home fa-fw" aria-hidden="true"></i>') }}
            {{ HTML::smartRoute_link_v2('obavijesti', 'Obavijesti', '<i class="fa fa-newspaper-o fa-fw" aria-hidden="true"></i>') }}
            {{ HTML::smartRoute_link_v2('kontakt', 'Kontakt', '<i class="fa fas fa-envelope-open fa-fw" aria-hidden="true"></i>') }}
        </ul>
    </nav>
</div><!-- /perspective -->

@stack('custom-news-vars')

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
