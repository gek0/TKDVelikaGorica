<?php

class AthleteController extends BaseController
{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show admin athletes
     * @return mixed
     */
    public function showAthletes()
    {
        $athletes_data = Athlete::orderBy('athlete_trophy', 'DESC')->get();

        return View::make('admin.athletes.athletes')->with(['page_title' => 'Administracija',
                                                    'athletes_data' => $athletes_data
        ]);
    }

    /**
     * show admin athlete edit
     * @return mixed
     */
    public function showUpdateAthlete($id = null)
    {
        if($id == null){
            return Redirect::to(route('admin-athletes'))->withErrors('Trener/sportaš ne postoji');
        }
        else{
            $athlete = Athlete::where('id', '=', $id)->first();
            if(!$athlete){
                return Redirect::to(route('admin-athletes'))->withErrors('Trener/sportaš ne postoji');
            }
            else{
                return View::make('admin.athletes.athletes-edit')->with(['page_title' => 'Administracija',
                                                                        'athlete' => $athlete
                ]);
            }
        }
    }

    /**
     * update athlete
     * @return mixed
     */
    public function updateAthlete()
    {
        $form_data = ['athlete_full_name' => e(Input::get('athlete_full_name')),
                    'athlete_profile_image' => Input::file('athlete_profile_image'),
                    'athlete_type' => e(Input::get('athlete_type')),
                    'athlete_birth_date' => e(Input::get('athlete_birth_date')),
                    'athlete_gender' => e(Input::get('athlete_gender')),
                    'athlete_trophy' => e(Input::get('athlete_trophy')),
                    'athlete_description' => e(Input::get('athlete_description')),
                    'profile_image_delete' => e(Input::get('profile_image_delete'))
        ];
        $token = Input::get('_token');
        $athlete_id = e(Input::get('id'));

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, Athlete::$rules, Athlete::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            $athlete = Athlete::where('id', '=', $athlete_id)->first();

            //check if there is image
            if($form_data['athlete_profile_image'] == true){
                //check for image directory
                $path = public_path().'/'.getenv('ATHLETES_UPLOAD_DIR').'/';
                if(!File::exists($path)){
                    File::makeDirectory($path, 0777);
                }

                $file_name = safe_name($form_data['athlete_full_name']).'_profile_image';
                $file_extension = $form_data['athlete_profile_image']->getClientOriginalExtension();
                $full_name = $file_name.'.'.$file_extension;

                $file_uploaded = $form_data['athlete_profile_image']->move($path, $full_name);
                $image_resize = Image::make($path.$full_name)->widen(250, function ($constraint) {
                    $constraint->upsize();
                })->save();
                if($file_uploaded){
                    $athlete->athlete_profile_image = $full_name;
                }
            }
            else{
                // delete existing if requested
                if(isset($form_data['profile_image_delete']) && $form_data['profile_image_delete'] == '1'){
                    File::delete(public_path().'/'.getenv('ATHLETES_UPLOAD_DIR').'/'.$athlete->athlete_profile_image);
                    $athlete->athlete_profile_image = null;
                }
            }

            $athlete->athlete_full_name = $form_data['athlete_full_name'];
            $athlete->athlete_type = $form_data['athlete_type'];
            $athlete->athlete_birth_date = $form_data['athlete_birth_date'];
            $athlete->athlete_gender = $form_data['athlete_gender'];
            $athlete->athlete_trophy = $form_data['athlete_trophy'];
            $athlete->athlete_description = $form_data['athlete_description'];
            $athlete->save();
        }

        return Redirect::to(route('admin-athletes'))->with(['success' => 'Trener/sportaš je uspješno izmjenjen']);
    }

    /**
     * add new athlete
     * @return mixed
     */
    public function addAthlete()
    {
        $form_data = ['athlete_full_name' => e(Input::get('athlete_full_name')),
            'athlete_profile_image' => Input::file('athlete_profile_image'),
            'athlete_type' => e(Input::get('athlete_type')),
            'athlete_birth_date' => e(Input::get('athlete_birth_date')),
            'athlete_gender' => e(Input::get('athlete_gender')),
            'athlete_trophy' => e(Input::get('athlete_trophy')),
            'athlete_description' => e(Input::get('athlete_description'))
        ];
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, Athlete::$rules, Athlete::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            // initialize new model object
            $athlete = new Athlete;

            //check if there is image
            if($form_data['athlete_profile_image'] == true){
                //check for image directory
                $path = public_path().'/'.getenv('ATHLETES_UPLOAD_DIR').'/';
                if(!File::exists($path)){
                    File::makeDirectory($path, 0777);
                }

                $file_name = safe_name($form_data['athlete_full_name']).'_profile_image_'.Str::random(5);
                $file_extension = $form_data['athlete_profile_image']->getClientOriginalExtension();
                $full_name = $file_name.'.'.$file_extension;

                $file_uploaded = $form_data['athlete_profile_image']->move($path, $full_name);
                $image_resize = Image::make($path.$full_name)->widen(250, function ($constraint) {
                    $constraint->upsize();
                })->save();
                if($file_uploaded){
                    $athlete->athlete_profile_image = $full_name;
                }
            }

            $athlete->athlete_full_name = $form_data['athlete_full_name'];
            $athlete->athlete_type = $form_data['athlete_type'];
            $athlete->athlete_birth_date = $form_data['athlete_birth_date'];
            $athlete->athlete_gender = $form_data['athlete_gender'];
            $athlete->athlete_trophy = $form_data['athlete_trophy'];
            $athlete->athlete_description = $form_data['athlete_description'];
            $athlete->save();
        }

        return Redirect::to(route('admin-athletes'))->with(['success' => 'Trener/sportaš je uspješno dodan']);
    }

    /**
     * delete athlete
     * @return mixed
     */
    public function deleteAthlete($id = null)
    {
        if($id == null){
            return Redirect::to(route('admin-athletes'))->withErrors('Trener/sportaš ne postoji');
        }
        else{
            $athlete = Athlete::where('id', '=', $id)->first();
            if(!$athlete){
                return Redirect::to(route('admin-athletes'))->withErrors('Trener/sportaš ne postoji');
            }
            else{

                try{
                    File::delete(public_path().'/'.getenv('ATHLETES_UPLOAD_DIR').'/'.$athlete->athlete_profile_image);
                    $athlete->delete();
                }
                catch(Exception $e){
                    return Redirect::to(route('admin-athletes'))->withErrors('Trener/sportaš i slika nisu mogli biti obrisani');
                }

                return Redirect::to(route('admin-athletes'))->with(['success' => 'Trener/sportaš je uspješno obrisan']);
            }
        }
    }
}