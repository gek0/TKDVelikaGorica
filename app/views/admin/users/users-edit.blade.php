@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <h2 class="text-center">Korisnici <i class="fa fa-angle-right" aria-hidden="true"></i> {{ $user->username }}</h2>

        {{ Form::open(['url' => route('admin-users-editPOST'), 'role' => 'form', 'id' => 'admin-users-edit', 'class' => 'form-element']) }}

        <div class="form-group">
            {{ Form::label('username', 'Korisničko ime:') }}
            {{ Form::text('username', $user->username, ['class' => 'form-input-control', 'placeholder' => 'Korisničko ime', 'required' => 'true']) }}
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('password', 'Lozinka:') }}
                    {{ Form::password('password', null, ['class' => 'form-input-control', 'placeholder' => 'Lozinka', 'autocomplete' => 'off']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('password_again', 'Lozinka ponovo:') }}
                    {{ Form::password('password_again', null, ['class' => 'form-input-control', 'placeholder' => 'Lozinka ponovo', 'autocomplete' => 'off']) }}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('email', 'E-mail adresa:') }}
            {{ Form::email('email', $user->email, ['class' => 'form-input-control', 'placeholder' => 'E-mail adresa', 'required' => 'true']) }}
        </div>
        <div class="text-center">
            {{ Form::hidden('id', $user->id) }}
            <button type="submit" class="btn btn-submit btn-submit-full">Izmjeni korisnika <i class="fa fa-check"></i></button>
        </div>
        {{ Form::close() }}

        <hr>
        <div class="space text-left">
            <a href="{{ route('admin-users') }}">
                <button class="btn btn-submit">Povratak na korisnike <i class="fa fa-users"></i></button>
            </a>
        </div>
    </div>
</div>

@include('admin.layout.footer')