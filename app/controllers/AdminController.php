<?php

class AdminController extends BaseController
{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show admin page home
     * @return mixed
     */
    public function showPageHome()
    {
        $cover_data = Cover::first();

        return View::make('admin.home')->with(['page_title' => 'Administracija',
                                                'cover_data' => $cover_data
        ]);
    }

    /**
     * update cover
     * @return mixed
     */
    public function updateCover()
    {
        $form_data = ['cover_title' => e(Input::get('cover_title')),
                        'cover_subtitle' => e(Input::get('cover_subtitle')),
                        'cover_logo' => e(Input::get('cover_logo')),
                        'cover_file_delete' => e(Input::get('cover_file_delete'))
        ];
        $cover_file = Input::file('cover_file');
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, Cover::$rules, Cover::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            // only one record in database
            $check_data = Cover::first();
            if($check_data == null){
                $cover = new Cover;
            }
            else{
                $cover = $check_data;
            }

            $path = public_path().'/'.getenv('COVER_UPLOAD_DIR').'/';

            if($cover_file == true){
                $valid_file_types = ['webm', 'jpg', 'jpeg', 'png'];
                if(!in_array($cover_file->getClientOriginalExtension(), $valid_file_types)){
                    return Redirect::to(route('admin-page-home'))->withErrors(['error' => 'Format datoteke nije važeći.']);
                }

                //check for image directory
                if(!File::exists($path)){
                    File::makeDirectory($path, 0777);
                }
                else{
                    File::delete($path.$cover->cover_file);
                }

                $file_name = getenv('WEB_NAME_URL_SAFE').'_cover';
                $file_extension = $cover_file->getClientOriginalExtension();
                $full_name = $file_name.'.'.$file_extension;
                $file_uploaded = $cover_file->move($path, $full_name);

                $cover->cover_file = $full_name;
                if($file_extension === 'webm'){
                    $cover->cover_type = 'video';
                }
                else{
                    $cover->cover_type = 'image';
                }
            }
            else{
                // delete existing if requested
                if(isset($form_data['cover_file_delete']) && $form_data['cover_file_delete'] == '1'){
                    $cover->cover_file = null;
                }
            }

            $cover->cover_title = $form_data['cover_title'];
            $cover->cover_subtitle = $form_data['cover_subtitle'];
            $cover->cover_logo = $form_data['cover_logo'];
            $cover->save();
        }

        return Redirect::to(route('admin-page-home'))->with(['success' => 'Naslovnica je uspješno izmjenjena']);
    }

    /**
     * show admin about us
     * @return mixed
     */
    public function showAboutUs()
    {
        $about_us_data = AboutUs::first();

        return View::make('admin.about-us')->with(['page_title' => 'Administracija',
                                                    'about_us_data' => $about_us_data
        ]);
    }

    /**
     * update about us section
     * @return mixed
     */
    public function updateAboutUs()
    {
        $form_data = Input::all();

        //check if csrf token is valid
        if(Session::token() != $form_data['_token']){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, AboutUs::$rules, AboutUs::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else {
            //only one record in database
            $check_data = AboutUs::first();
            if($check_data == null){
                $about_us = new AboutUs;
            }
            else{
                $about_us = $check_data;
            }

            $about_us->about_title = $form_data['about_title'];
            $about_us->about_body = $form_data['about_body'];
            $about_us->save();
        }

        return Redirect::to(route('admin-about-us'))->with(['success' => 'Sekcija "O nama" je uspješno izmjenjena']);
    }

    /**
 * show admin about club
 * @return mixed
 */
    public function showAboutClub()
    {
        $about_club_data = AboutClub::first();

        return View::make('admin.about-club')->with(['page_title' => 'Administracija',
            'about_club_data' => $about_club_data
        ]);
    }

    /**
     * update about club section
     * @return mixed
     */
    public function updateAboutClub()
    {
        $form_data = Input::all();

        //check if csrf token is valid
        if(Session::token() != $form_data['_token']){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, AboutClub::$rules, AboutClub::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else {
            //only one record in database
            $check_data = AboutClub::first();
            if($check_data == null){
                $about_club = new AboutClub;
            }
            else{
                $about_club = $check_data;
            }

            $about_club->about_title = $form_data['about_title'];
            $about_club->about_body = $form_data['about_body'];
            $about_club->save();
        }

        return Redirect::to(route('admin-about-club'))->with(['success' => 'Sekcija "O klubu" je uspješno izmjenjena']);
    }

    /**
     * show admin notification
     * @return mixed
     */
    public function showNotification()
    {
        $notification_data = Notification::first();

        return View::make('admin.notification-section')->with(['page_title' => 'Administracija',
                                                    'notification_data' => $notification_data
        ]);
    }

    /**
     * update about notification
     * @return mixed
     */
    public function updateNotification()
    {
        $form_data = Input::all();

        //check if csrf token is valid
        if(Session::token() != $form_data['_token']){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, Notification::$rules, Notification::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else {
            //only one record in database
            $check_data = Notification::first();
            if($check_data == null){
                $notification = new Notification;
            }
            else{
                $notification = $check_data;
            }

            $notification->title = $form_data['title'];
            $notification->body = $form_data['body'];
            $notification->enabled = $form_data['notification_status'];
            $notification->save();
        }

        return Redirect::to(route('admin-notification'))->with(['success' => 'Sekcija "Notifikacija" je uspješno izmjenjena']);
    }

    /**
     * show admin info
     * @return mixed
     */
    public function showInfo()
    {
        $info_data = Info::first();

        return View::make('admin.info')->with(['page_title' => 'Administracija',
                                                'info_data' => $info_data
        ]);
    }

    /**
     * update info
     * @return mixed
     */
    public function updateInfo()
    {
        $form_data = Input::all();
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, Info::$rules, Info::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            // only one record in database
            $check_data = Info::first();
            if($check_data == null){
                $info = new Info;
            }
            else{
                $info = $check_data;
            }

            $info->owner_contact_email = $form_data['owner_contact_email'];
            $info->owner_contact_phone = $form_data['owner_contact_phone'];
            $info->owner_contact_address = $form_data['owner_contact_address'];
            $info->owner_contact_address_2 = $form_data['owner_contact_address_2'];
            $info->web_email_subject = $form_data['web_email_subject'];
            $info->bank_account = $form_data['bank_account'];
            $info->iban_number = $form_data['iban_number'];
            $info->oib_number = $form_data['oib_number'];
            $info->facebook_url = $form_data['facebook_url'];
            $info->instagram_url = $form_data['instagram_url'];
            $info->twitter_url = $form_data['twitter_url'];
            $info->youtube_url = $form_data['youtube_url'];
            $info->map_lat = $form_data['map_lat'];
            $info->map_lng = $form_data['map_lng'];
            $info->map_2_lat = $form_data['map_2_lat'];
            $info->map_2_lng = $form_data['map_2_lng'];
            $info->save();
        }

        return Redirect::to(route('admin-info'))->with(['success' => 'Informacije su uspješno izmjenjene']);
    }

    /**
     * show admin sections
     * @return mixed
     */
    public function showSections()
    {
        $sections_data = Section::get();

        return View::make('admin.sections')->with(['page_title' => 'Administracija',
                                                'sections_data' => $sections_data
        ]);
    }

    /**
     * update sections
     * @return mixed
     */
    public function updateSections()
    {
        $form_data = Input::all();
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        array_shift($form_data); // remove token from array
        $sections_info = array_chunk($form_data, 2); // split array to multiple ones containing section_name and section_status/enabled
        foreach($sections_info as $sec){
            $section = Section::where('section_name', '=', $sec[0])->first();
            $section->enabled = $sec[1];
            $section->save();
        }

        return Redirect::to(route('admin-sections'))->with(['success' => 'Sekcije su uspješno izmjenjene']);
    }
}