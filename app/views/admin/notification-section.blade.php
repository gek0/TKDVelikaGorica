@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <div id="cover-image">
            {{ Form::open(['url' => route('admin-notificationPOST'), 'role' => 'form', 'id' => 'notification', 'class' => 'form-element']) }}
            <div class="form-group">
                {{ Form::label('title', 'Naslov notifikacije:') }}
                {{ Form::text('title', $notification_data['title'], ['class' => 'form-input-control', 'placeholder' => 'Naslov notifikacije', 'required' => 'true']) }}
            </div>
            <div class="form-group">
                {{ Form::label('body', 'Tekst notifikacije:') }}
                {{ Form::textarea('body', $notification_data['body'], ['class' => 'form-input-control', 'placeholder' => 'Tekst notifikacije', 'id' => 'codeEditor']) }}
            </div>

           <div class="form-group text-center">
                <label for="notification_status">Notifikacija vidljiva:</label>
                <div data-toggle="buttons">
                    <label class="btn btn-default btn-circle btn-lg @if($notification_data['enabled'] === 'yes') active @endif">
                        <input type="radio" name="notification_status" value="yes" @if($notification_data['enabled'] === 'yes') checked @endif>Da <i class="fa fas fa-check fa-fw"></i>
                    </label>
                    <label class="btn btn-default btn-circle btn-lg @if($notification_data['enabled'] === 'no') active @endif">
                        <input type="radio" name="notification_status" value="no" @if($notification_data['enabled'] === 'no') checked @endif>Ne <i class="fa fas fa-times fa-fw"></i>
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

@include('admin.layout.footer')