<?php

class LoginController extends BaseController{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show login page
     * @return mixed
     */
    public function showLogin()
    {
        if(Auth::guest()){
            $intended_url = Session::get('url.intended', url(route('admin-page-home')));
            Session::forget('url.intended');

            return View::make('public.login')->with(['page_title' => 'Administracija',
                                                    'intended_url' => $intended_url
            ]);
        }
        else{
            return Redirect::to(route('admin-page-home'));
        }
    }

    /**
     * user login data validation
     * @return mixed
     */
    public function checkLogin()
    {
        //check if user is already authorized
        if(Auth::user()){
            return Redirect::to(route('admin-page-home'));
        }

        if (Request::ajax()) {

            //get input data
            $input_data = Input::get('formData');
            $token = Input::get('_token');
            $user_data = ['username' => e($input_data['username']),
                          'password' => $input_data['password']
            ];

            //check if csrf token is valid
            if(Session::token() != $token){
                return Response::json(['status' => 'error',
                                        'errors' => 'Nevažeći CSRF token'
                ]);
            }

            // permanent session
            if(isset($input_data['remember_me']) && $input_data['remember_me'] == '1'){
                $remember_me = true;
            }
            else{
                $remember_me = false;
            }

            if (Auth::attempt(['username' => $user_data['username'], 'password' => $user_data['password']], $remember_me)) {
                return Response::json(['status' => 'success']);
            }
            else {
                return Response::json(['status' => 'error',
                                        'errors' => 'Neispravno korisničko ime ili lozinka'
                ]);
            }
        }
        else{
            return Response::json(['status' => 'error',
                                    'errors' => 'Podaci nisu poslani Ajax-om'
            ]);
        }
    }
}