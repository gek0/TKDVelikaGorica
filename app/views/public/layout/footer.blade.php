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

<!-- scripts -->
{{ HTML::script('https://apis.google.com/js/platform.js', ['charset' => 'utf-8']) }}
{{ HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAq_DC0fNjXxqN-dTvo6PhN_ifxBvBcCWI', ['charset' => 'utf-8']) }}
{{ HTML::script('js/gmaps.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/main.js', ['charset' => 'utf-8']) }}

</body>
</html>
