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
}