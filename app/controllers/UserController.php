<?php

class UserController extends BaseController
{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show admin users
     * @return mixed
     */
    public function showUsers()
    {
        $users_data = User::orderBy('id', 'ASC')->get();

        return View::make('admin.users.users')->with(['page_title' => 'Administracija',
                                                'users_data' => $users_data
        ]);
    }

    /**
     * show admin user edit
     * @return mixed
     */
    public function showUpdateUser($id = null)
    {
        if($id == null){
            return Redirect::to(route('admin-users'))->withErrors('Korisnik ne postoji');
        }
        else{
            $user = User::where('id', '=', $id)->first();
            if(!$user){
                return Redirect::to(route('admin-users'))->withErrors('Korisnik ne postoji');
            }
            else{
                return View::make('admin.users.users-edit')->with(['page_title' => 'Administracija',
                                                            'user' => $user
                ]);
            }
        }
    }

    /**
     * update user
     * @return mixed
     */
    public function updateUser()
    {
        $form_data = ['username' => e(Input::get('username')), 'password' => Input::get('password'), 'password_again' => Input::get('password_again'), 'email' => e(Input::get('email'))];
        $token = Input::get('_token');
        $user_id = e(Input::get('id'));

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token');
        }

        $validator = Validator::make($form_data, User::$rulesLessStrict, User::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            $user = User::where('id', '=', $user_id)->first();
            $user->username = $form_data['username'];
            if(!empty($form_data['password']) && !empty($form_data['password'])){
                $user->password = Hash::make($form_data['password']);
            }
            $user->email = $form_data['email'];
            $user->save();
        }

        return Redirect::to(route('admin-users'))->with(['success' => 'Korisnik je uspješno izmjenjen']);
    }

    /**
     * add user
     * @return mixed
     */
    public function addUser()
    {
        $form_data = ['username' => e(Input::get('username')), 'password' => Input::get('password'), 'password_again' => Input::get('password_again'), 'email' => e(Input::get('email'))];
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, User::$rules, User::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            $user = new User;
            $user->username = $form_data['username'];
            $user->password = Hash::make($form_data['password']);
            $user->email = $form_data['email'];
            $user->save();
        }

        return Redirect::to(route('admin-users'))->with(['success' => 'Korisnik je uspješno dodan']);
    }

    /**
     * delete user
     * @return mixed
     */
    public function deleteUser($id = null)
    {
        if($id == null){
            return Redirect::to(route('admin-users'))->withErrors('Korisnik ne postoji');
        }
        else{
            $user = User::where('id', '=', $id)->first();
            if(!$user){
                return Redirect::to(route('admin-users'))->withErrors('Korisnik ne postoji');
            }
            else{
                $user->delete();
                return Redirect::to(route('admin-users'))->with(['success' => 'Korisnik je uspješno obrisan']);
            }
        }
    }
}