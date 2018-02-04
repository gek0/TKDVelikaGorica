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
        $form_data = ['cover_title' => e(Input::get('cover_title')), 'cover_subtitle' => e(Input::get('cover_subtitle'))];
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

            $cover->cover_title = $form_data['cover_title'];
            $cover->cover_subtitle = $form_data['cover_subtitle'];
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
            $info->web_email_subject = $form_data['web_email_subject'];
            $info->bank_account = $form_data['bank_account'];
            $info->iban_number = $form_data['iban_number'];
            $info->oib_number = $form_data['oib_number'];
            $info->facebook_url = $form_data['facebook_url'];
            $info->twitter_url = $form_data['twitter_url'];
            $info->youtube_url = $form_data['youtube_url'];
            $info->save();
        }

        return Redirect::to(route('admin-info'))->with(['success' => 'Informacije su uspješno izmjenjene']);
    }
}