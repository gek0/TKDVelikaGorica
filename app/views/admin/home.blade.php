@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <div id="cover-image">
            {{ Form::open(['url' => route('admin-cover-editPOST'), 'role' => 'form', 'id' => 'admin-cover-image', 'class' => 'form-element']) }}
            <div class="form-group">
                {{ Form::label('cover_title', 'Naslov:') }}
                {{ Form::text('cover_title', $cover_data['cover_title'], ['class' => 'form-input-control', 'placeholder' => 'Naslov']) }}
            </div>

            <div class="form-group">
                {{ Form::label('cover_subtitle', 'Podnaslov:') }}
                {{ Form::text('cover_subtitle', $cover_data['cover_subtitle'], ['class' => 'form-input-control', 'placeholder' => 'Podnaslov']) }}
            </div>

           <div class="form-group text-center">
                {{ Form::label('cover_logo', 'Prikaz logotipa:') }}
                <div data-toggle="buttons">
                    <label class="btn btn-default btn-circle btn-lg @if($cover_data['cover_logo'] === 'yes') active @endif">
                        <input type="radio" name="cover_logo" value="yes" @if($cover_data['cover_logo'] === 'yes') checked @endif>Da <i class="fa fas fa-check fa-fw"></i>
                    </label>
                    <label class="btn btn-default btn-circle btn-lg @if($cover_data['cover_logo'] === 'no') active @endif">
                        <input type="radio" name="cover_logo" value="no" @if($cover_data['cover_logo'] === 'no') checked @endif>Ne <i class="fa fas fa-times fa-fw"></i>
                    </label>
                </div>
           </div>

            <div class="text-center">
                <button type="submit" class="btn btn-submit btn-submit-full">Spremi izmjene <i class="fa fa-check"></i></button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@push('custom-scripts')
<script>
    jQuery(document).ready(function(){
        /**
         * delete confirmation
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