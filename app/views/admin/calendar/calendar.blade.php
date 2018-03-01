@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        {{ Form::open(['url' => route('admin-calendarPOST'), 'role' => 'form', 'id' => 'admin-calendar', 'class' => 'form-element']) }}

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('event_title', 'Naziv eventa:') }}
                {{ Form::text('event_title', null, ['class' => 'form-input-control', 'placeholder' => 'Naziv eventa', 'id' => 'event_title', 'required' => 'true']) }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('start_time', 'Datum početka eventa:') }}
                <input id="start_time" name="start_time" type="date" placeholder="Datum početka eventa" class="'form-input-control" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('end_time', 'Datum završetka eventa:') }}
                <input id="end_time" name="end_time" type="date" placeholder="Datum završetka eventa" class="'form-input-control" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group text-center">
                {{ Form::label('event_color', 'Boja označavanja eventa:') }}
                <input id="event_color" name="event_color" type="color" placeholder="Boja označavanja eventa" class="'form-input-control" value="#ed6f00">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('event_url', 'URL eventa (link na članak ili zasebnu stranicu):') }}
                {{ Form::url('event_url', null, ['class' => 'form-input-control', 'placeholder' => 'URL eventa', 'id' => 'event_url']) }}
            </div>
        </div>

        <div class="space text-center">
            <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
        </div>
        {{ Form::close() }}

        <ul class="nav nav-pills custom-pills">
            <li class="active"><a data-toggle="pill" href="#calendar-view"><i class="fa fa-calendar"></i> Pregled kalendara</a></li>
            <li><a data-toggle="pill" href="#calendar-edit"><i class="fa fa-pencil"></i> Izmjena kalendara</a></li>
        </ul>
        <hr>

        <!-- start tab-content -->
        <div class="tab-content">
            <div id="calendar-view" class="tab-pane fade in active">
                @if($events->count() > 0)
                    {{ $calendar->calendar() }}
                @else
                    <h3 class="text-center">Trenutno nema događaja zabilježenih na kalendaru.</h3>
                @endif
            </div>
            <div id="calendar-edit" class="tab-pane fade">
                @if($events->count() > 0)
                    <table class="table table-bordered table-responsive table-striped table-hover table-condensed" id="data-table">
                        <thead class="text-center text-bold">
                        <tr>
                            <td>Naziv eventa</td>
                            <td>Datum početka</td>
                            <td>Datum završetka</td>
                            <td>Boja</td>
                            <td>URL eventa</td>
                            <td>Opcije</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $e)
                            <tr>
                                <td>
                                    <span>{{ $e->event_title }}</span>
                                </td>
                                <td>
                                    <span>{{ $e->getStartTimeFormated() }}</span>
                                </td>
                                <td>
                                    <span>{{ $e->getEndTimeFormated() }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="color-event-box" style="background-color: {{ $e->event_color }}">&nbsp;</span>
                                </td>
                                <td>
                                    <span>
                                        <a href="{{ $e->event_url }}" target="_blank">{{ Str::limit($e->event_url, 20) }}</a>
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin-event-edit', $e->id) }}">
                                        <button id="{{ $e->id }}" class="btn btn-submit-edit" title="Izmjena eventa {{ $e->event_title }}">
                                            Izmjeni <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('admin-event-delete', $e->id) }}">
                                        <button id="{{ $e->id }}" class="btn btn-submit-delete" title="Brisanje eventa {{ $e->event_title }}">
                                            Obriši <i class="fa fa-trash"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">Trenutno nema događaja zabilježenih na kalendaru.</h3>
                @endif
            </div>
        </div>
        <!-- end tab-content -->
    </div>
</div>

@push('custom-scripts')
    {{ $calendar->script() }}

    <script>
        jQuery(document).ready(function(){
            /**
             * delete event confirmation
             */
            $(".btn-submit-delete").click(function(event){
                event.preventDefault();
                var delete_url_redirect = $(this).parent().attr("href");

                swal({
                    title: 'Sigurno to želiš?',
                    text: 'Ova radnja je nepovratna.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Da',
                    cancelButtonText: 'Ne, odustani!',
                    confirmButtonClass: 'btn btn-padded-smaller btn-submit-edit',
                    cancelButtonClass: 'btn btn-padded-smaller btn-submit-delete',
                    buttonsStyling: true
                }).then(function () {
                    window.location.href = delete_url_redirect;
                }, function (dismiss) {
                    if (dismiss === 'cancel') {
                        swal(
                                'Odustanak',
                                'Nije obrisano :)',
                                'error'
                        )
                    }
                })
            });
        });
    </script>
@endpush

@include('admin.layout.footer')