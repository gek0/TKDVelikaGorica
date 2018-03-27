@include('public.layout.header')

<div class="container-contact-full-flex">
    <div class="contact-full-flex-map" id="google_map" data-map-x="{{ $info_data->map_lat }}" data-map-y="{{ $info_data->map_lng }}" data-map-2-x="{{ $info_data->map_2_lat }}" data-map-2-y="{{ $info_data->map_2_lng }}" data-pin="{{ asset('css/assets/images/map-marker.png') }}" data-zoom="{{ getenv('DEFAULT_MAP_ZOOM_LEVEL') }}" data-tooltip-text="{{ getenv('WEB_NAME') }}" data-scrollwhell="0" data-draggable="1"></div>

    <div class="wrap-contact-full-flex">
        {{ Form::open(['url' => route('contactPOST'), 'role' => 'form', 'id' => 'contact-form', 'class' => 'contact-full-flex-form validate-form']) }}
            <span class="full-flex-form-title">
                <h1 class="to-animate text-center">{{ $page_title }}</h1>
            </span>

            <div class="contact-info-sub">
                <ul class="list-group list-group-flush info-sub-list">
                    @if($info_data->owner_contact_email)
                        <li class="list-group-item" alt="Kontakt e-mail" title="Kontakt e-mail">
                            <i class="fa fas fa-envelope-open fa-big fa-fw"></i>
                            <span>{{ Html::mailto($info_data->owner_contact_email)  }}</span>
                        </li>
                    @endif
                    @if($info_data->owner_contact_phone)
                        <li class="list-group-item" alt="Kontakt telefon" title="Kontakt telefon">
                            <i class="fa fas fa-phone fa-big fa-fw"></i>
                            <span>{{ $info_data->owner_contact_phone }}</span>
                        </li>
                    @endif
                    @if($info_data->owner_contact_address)
                        <li class="list-group-item" alt="Lokacija" title="Lokacija">
                            <i class="fa fas fa-home fa-big fa-fw"></i>
                            <a href="https://www.google.com/maps?ll={{ $info_data->map_lat or '' }},{{ $info_data->map_lng or '' }}&z=13&t=m&hl=en-US&gl=US&mapclient=apiv3" target="_blank">
                                {{ $info_data->owner_contact_address }}
                            </a>
                        </li>
                    @endif
                    @if($info_data->owner_contact_address_2)
                        <li class="list-group-item" alt="Druga lokacija" title="Druga lokacija">
                            <i class="fa fas fa-home fa-big fa-fw"></i>
                            <a href="https://www.google.com/maps?ll={{ $info_data->map_2_lat or '' }},{{ $info_data->map_2_lng or '' }}&z=13&t=m&hl=en-US&gl=US&mapclient=apiv3" target="_blank">
                                {{ $info_data->owner_contact_address_2 }}
                            </a>
                        </li>
                    @endif
                    @if($info_data->bank_account)
                        <li class="list-group-item" alt="Broj računa" title="Broj računa">
                            <i class="fa fab fa-cc-visa fa-big fa-fw"></i>
                            <span>{{ $info_data->bank_account }}</span>
                    </li>
                    @endif
                    @if($info_data->iban_number)
                        <li class="list-group-item" alt="IBAN" title="IBAN">
                            <i class="fa far fa-credit-card fa-big fa-fw"></i>
                            <span>{{ $info_data->iban_number }}</span>
                        </li>
                    @endif
                    @if($info_data->oib_number)
                        <li class="list-group-item" alt="OIB" title="OIB">
                            <i class="fa fas fa-id-card fa-big fa-fw"></i>
                            <span>{{ $info_data->oib_number }}</span>
                        </li>
                    @endif
                    @if($info_data->facebook_url)
                        <li class="list-group-item" alt="Facebook" title="Facebook">
                            <i class="fa fab fa-facebook-square fa-big fa-fw"></i>
                            <a href="{{ $info_data->facebook_url }}" target="_blank">Facebook</a>
                        </li>
                    @endif
                    @if($info_data->twitter_url)
                        <li class="list-group-item" alt="Twitter" title="Twitter">
                            <i class="fa fab fa-twitter-square fa-big fa-fw"></i>
                            <a href="{{ $info_data->twitter_url }}" target="_blank">Twitter</a>
                        </li>
                    @endif
                    @if($info_data->youtube_url)
                        <li class="list-group-item" alt="YouTube" title="YouTube">
                            <i class="fa fab fa-youtube-square fa-big fa-fw"></i>
                            <a href="{{ $info_data->youtube_url }}" target="_blank">YouTube</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="wrap-input-full-flex validate-input" data-validate="Ime i prezime su obavezni">
                <span class="label-input-full-flex">Ime i prezime:</span>
                {{ Form::text('full_name', null, ['class' => 'input-full-flex', 'placeholder' => 'Vaše ime i prezime', 'id' => 'full_name', 'required' => 'true']) }}
                <span class="focus-input-full-flex"></span>
            </div>

            <div class="wrap-input-full-flex validate-input" data-validate="Važeća e-mail adresa je obavezna">
                <span class="label-input-full-flex">E-mail adresa:</span>
                {{ Form::email('email', null, ['class' => 'input-full-flex', 'placeholder' => 'Vaša e-mail adresa', 'id' => 'email', 'required' => 'true']) }}
                <span class="focus-input-full-flex"></span>
            </div>

            <div class="wrap-input-full-flex validate-input" data-validate="Naslov poruke je obavezan">
                <span class="label-input-full-flex">Naslov poruke:</span>
                {{ Form::text('subject', null, ['class' => 'input-full-flex', 'placeholder' => 'Naslov poruke', 'id' => 'subject', 'required' => 'true']) }}
                <span class="focus-input-full-flex"></span>
            </div>

            <div class="wrap-input-full-flex validate-input" data-validate="Tekst poruke je obavezan">
                <span class="label-input-full-flex">Tekst poruke:</span>
                {{ Form::textarea('message_body', null, ['class' => 'input-full-flex', 'placeholder' => 'Tekst poruke', 'id' => 'message_body', 'required' => 'true']) }}
                <span class="focus-input-full-flex"></span>
            </div>

            <div class="row text-center forced-margin">
                <div class="col-md-12 form-group captcha">
                    {{ Form::captcha() }}
                </div>

                <div class="col-md-12 form-group space">
                    <button type="submit" class="button-prim" id="contactSubmit">
                        <i class="fa fas fa-paper-plane fa-mid"></i> Pošaljite upit
                    </button>
                </div>
            </div>
        </form>

        <div id="map-container-mobile" data-map-x="{{ $info_data->map_lat }}" data-map-y="{{ $info_data->map_lng }}" data-map-2-x="{{ $info_data->map_2_lat }}" data-map-2-y="{{ $info_data->map_2_lng }}" data-pin="{{ asset('css/assets/images/map-marker.png') }}" data-zoom="{{ getenv('DEFAULT_MAP_ZOOM_LEVEL') }}" data-tooltip-text="{{ getenv('WEB_NAME') }}" data-scrollwhell="0" data-draggable="1"></div>
    </div>
</div> <!-- end container-contact-full-flex -->

@include('public.layout.footer')
