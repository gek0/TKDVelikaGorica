
    <div class="row text-center">
        <hr>
        <div class="col-md-12">
            <p>&copy; <b>{{ getenv('WEB_NAME') }}</b>, {{ date('Y') }} | Made with <i class="fa fa-heart pulseAnim red" title="love"></i>  by <a href="{{ url('https://github.com/gek0') }}" target="_blank">Matija</a></p>
        </div>
    </div>
</div>
</section>

@include('admin.notification')

<!-- scripts -->
{{ HTML::script('js/jquery.dataTables.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/dataTables.bootstrap.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/dataTables.responsive.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/dataTables.rowReorder.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('wysibb/jquery.wysibb.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('wysibb/lang/hr.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/jquery.lazyload.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/bootstrap-tagsinput.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/fileinput.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/imagelightbox.min.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/jquery.easing.1.3.js', ['charset' => 'utf-8']) }}
{{ HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyAq_DC0fNjXxqN-dTvo6PhN_ifxBvBcCWI', ['charset' => 'utf-8']) }}
{{ HTML::script('js/gmaps.js', ['charset' => 'utf-8']) }}
{{ HTML::script('js/main_admin.js', ['charset' => 'utf-8']) }}

@stack('custom-scripts')

</body>
</html>