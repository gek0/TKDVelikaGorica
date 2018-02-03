@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        {{ Form::open(['url' => route('admin-usersPOST'), 'role' => 'form', 'id' => 'admin-users', 'class' => 'form-element']) }}

        <div class="form-group">
            {{ Form::label('username', 'Korisničko ime:') }}
            {{ Form::text('username', null, ['class' => 'form-input-control', 'placeholder' => 'Korisničko ime', 'required' => 'true']) }}
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('password', 'Lozinka:') }}
                    {{ Form::password('password', null, ['class' => 'form-input-control', 'placeholder' => 'Lozinka', 'autocomplete' => 'off', 'required' => 'true']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('password_again', 'Lozinka ponovo:') }}
                    {{ Form::password('password_again', null, ['class' => 'form-input-control', 'placeholder' => 'Lozinka ponovo', 'autocomplete' => 'off', 'required' => 'true']) }}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('email', 'E-mail adresa:') }}
            {{ Form::email('email', null, ['class' => 'form-input-control', 'placeholder' => 'E-mail adresa', 'required' => 'true']) }}
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-submit btn-submit-full">Dodaj korisnika <i class="fa fa-check"></i></button>
        </div>
        {{ Form::close() }}

        <div class="text-center space">
            <h3>Trenutni korisnici:</h3>
            <table class="table table-bordered table-responsive table-striped table-hover table-condensed" id="data-table">
                <thead>
                    <tr>
                        <td style="width: 20%;"><i class="fa fa-user" aria-hidden="true"></i> Korisničko ime</td>
                        <td><i class="fa fa-envelope" aria-hidden="true"></i> E-mail</td>
                        <td><i class="fa fa-cog fa-spin" aria-hidden="true"></i> Opcije</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($users_data as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('admin-users-edit', $user->id) }}">
                                <button class="btn btn-submit-edit">
                                    Izmjeni <i class="fa fa-pencil"></i>
                                </button>
                            </a>
                            @if(Auth::user()->id !== $user->id)
                                <a href="{{ route('admin-users-delete', $user->id) }}">
                                    <button class="btn btn-submit-delete">
                                        Obriši <i class="fa fa-trash"></i>
                                    </button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('custom-scripts')
<script>
    jQuery(document).ready(function(){
        /**
         * delete user confirmation
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
                            'Korisnik je siguran od brisanja :)',
                            'error'
                    )
                }
            })
        });
    });
</script>
@endpush

@include('admin.layout.footer')