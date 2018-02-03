@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        {{ Form::open(['url' => route('admin-event-editPOST'), 'role' => 'form', 'id' => 'admin-calendar', 'class' => 'form-element']) }}

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('event_title', 'Naziv eventa:') }}
                {{ Form::text('event_title', $event->event_title, ['class' => 'form-input-control', 'placeholder' => 'Naziv eventa', 'id' => 'event_title', 'required' => 'true']) }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('start_time', 'Datum početka eventa:') }}
                <input id="start_time" name="start_time" type="date" value="{{ date('Y-m-d', strtotime($event->start_time)) }}" placeholder="{{ date('Y-m-d', strtotime($event->start_time)) }}" class="'form-input-control" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('end_time', 'Datum završetka eventa:') }}
                <input id="end_time" name="end_time" type="date" value="{{ date('Y-m-d', strtotime($event->end_time)) }}" placeholder="{{ date('Y-m-d', strtotime($event->end_time)) }}" class="'form-input-control" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('event_color', 'Boja označavanja eventa:') }}
                <input id="event_color" name="event_color" type="color" placeholder="Boja označavanja eventa" class="'form-input-control" value="{{ $event->event_color }}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('event_url', 'URL eventa (link na članak ili zasebnu stranicu):') }}
                {{ Form::url('event_url', $event->event_url, ['class' => 'form-input-control', 'placeholder' => 'URL eventa', 'id' => 'event_url']) }}
            </div>
        </div>

        <div class="space text-center">
            {{ Form::hidden('id', $event->id) }}
            <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
        </div>
{{ Form::close() }}

@include('admin.layout.footer')