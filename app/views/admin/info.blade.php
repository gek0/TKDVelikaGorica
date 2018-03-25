@include('admin.layout.header')

<div class="row">
    <div class="col-lg-8 col-lg-offset-2" id="layout-block-main">
        <div id="cover-image">
            {{ Form::open(['url' => route('admin-infoPOST'), 'role' => 'form', 'id' => 'admin-info', 'class' => 'form-element']) }}
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('owner_contact_email', 'Kontakt e-mail adresa:') }}
                    {{ Form::email('owner_contact_email', $info_data['owner_contact_email'], ['class' => 'form-input-control', 'placeholder' => 'Kontakt e-mail adresa']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('owner_contact_phone', 'Broj kontakt telefona:') }}
                    {{ Form::text('owner_contact_phone', $info_data['owner_contact_phone'], ['class' => 'form-input-control', 'placeholder' => 'Broj kontakt telefona']) }}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('web_email_subject', 'Naslov e-maila zaprimljenog s weba:') }}
                    {{ Form::text('web_email_subject', $info_data['web_email_subject'], ['class' => 'form-input-control', 'placeholder' => 'Naslov e-maila zaprimljenog s weba']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('bank_account', 'Broj računa u banci:') }}
                    {{ Form::text('bank_account', $info_data['bank_account'], ['class' => 'form-input-control', 'placeholder' => 'Broj računa u banci']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('iban_number', 'IBAN:') }}
                    {{ Form::text('iban_number', $info_data['iban_number'], ['class' => 'form-input-control', 'placeholder' => 'IBAN']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('oib_number', 'OIB:') }}
                    {{ Form::text('oib_number', $info_data['oib_number'], ['class' => 'form-input-control', 'placeholder' => 'OIB']) }}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('facebook_url', 'Facebook URL:') }}
                    {{ Form::url('facebook_url', $info_data['facebook_url'], ['class' => 'form-input-control', 'placeholder' => 'Facebook URL']) }}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('instagram_url', 'Instagram URL:') }}
                    {{ Form::url('instagram_url', $info_data['instagram_url'], ['class' => 'form-input-control', 'placeholder' => 'Instagram URL']) }}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('twitter_url', 'Twitter URL:') }}
                    {{ Form::url('twitter_url', $info_data['twitter_url'], ['class' => 'form-input-control', 'placeholder' => 'Twitter URL']) }}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('youtube_url', 'YouTube URL:') }}
                    {{ Form::url('youtube_url', $info_data['youtube_url'], ['class' => 'form-input-control', 'placeholder' => 'YouTube URL']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('owner_contact_address', 'Adresa dvorane:') }}
                    {{ Form::text('owner_contact_address', $info_data['owner_contact_address'], ['class' => 'form-input-control', 'placeholder' => 'Adresa dvorane']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('map_lat', 'Lokacija dvorane - širina (latitude):') }}
                    {{ Form::text('map_lat', $info_data['map_lat'], ['class' => 'form-input-control', 'placeholder' => 'Zemljopisna širina (latitude) npr. 43.172362', 'id' => 'map_lat', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('map_lng', 'Lokacija dvorane - dužina (longitude):') }}
                    {{ Form::text('map_lng', $info_data['map_lng'], ['class' => 'form-input-control', 'placeholder' => 'Zemljopisna dužina (longitude), npr. 16.4408177', 'id' => 'map_lng', 'required' => 'true']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('owner_contact_address_2', 'Adresa druge dvorane:') }}
                    {{ Form::text('owner_contact_address_2', $info_data['owner_contact_address_2'], ['class' => 'form-input-control', 'placeholder' => 'Adresa druge dvorane']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('map_2_lat', 'Lokacija druge dvorane - širina (latitude):') }}
                    {{ Form::text('map_2_lat', $info_data['map_2_lat'], ['class' => 'form-input-control', 'placeholder' => 'Zemljopisna širina (latitude) npr. 43.172362', 'id' => 'map_2_lat']) }}
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('map_2_lng', 'Lokacija druge dvorane - dužina (longitude):') }}
                    {{ Form::text('map_2_lng', $info_data['map_2_lng'], ['class' => 'form-input-control', 'placeholder' => 'Zemljopisna dužina (longitude), npr. 16.4408177', 'id' => 'map_2_lng']) }}
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