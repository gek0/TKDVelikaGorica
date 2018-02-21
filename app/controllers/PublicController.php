<?php

class PublicController extends BaseController {

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    protected $news_paginate = 5;
    protected $sort_data = ['added_desc' => 'Najnovije vijesti',
                            'added_asc' => 'Najstarije vijesti',
                            'visits_desc' => 'S najviše pregleda',
                            'visits_asc' => 'S najmanje pregleda'
    ];

    /**
     * show homepage
     * @return mixed
     */
    public function showHome()
    {
        $cover_data = Cover::first();

        return View::make('public.index')->with(['page_title' => 'Dobrodošli',
                                                'cover_data' => $cover_data
        ]);
    }

    /**
     * show contact page
     * @return mixed
     */
    public function showContact()
    {
        $info_data = Info::first();

        return View::make('public.contact')->with(['page_title' => 'Kontakt',
                                                'info_data' => $info_data
        ]);
    }

    /**
     * send email from contact form over Ajax request
     * @return mixed
     */
    public function sendMail()
    {
        if (Request::ajax()) {
            //define validator rules and messages
            $rules = ['full_name' => 'required|between:2,100',
                        'email' => 'required|email',
                        'subject' => 'required|between:2,100',
                        'message_body' => 'required|min:10',
                        'g-recaptcha-response' => 'required|captcha'
            ];
            $messages = ['full_name.required' => 'Zaboravili ste unjeti ime i prezime',
                        'full_name.between' => 'Ime i prezime ne mogu biti dulji od 100 znakova i kraći od 2',
                        'email.required' => 'E-mail adresa je obavezno polje',
                        'email.email' => 'Unjeta e-mail adresa nije važeća',
                        'subject.required' => 'Zaboravili ste unjeti naslov poruke',
                        'subject.between' => 'Naslov poruke ne može biti dulji od 100 znakova i kraći od 2',
                        'message_body.required' => 'Poruka je obavezno polje',
                        'message_body.min' => 'Poruka je prekratka, minimalno 10 znakova',
                        'g-recaptcha-response.required' => 'Captcha je obavezna',
                        'g-recaptcha-response.captcha' => 'Captcha nije važeća'
            ];

            //get form data
            $input_data = Input::get('formData');
            $token = Input::get('_token');
            $user_data = ['full_name' => e($input_data['full_name']),
                        'email' => e($input_data['email']),
                        'subject' => e($input_data['subject']),
                        'message_body' => e($input_data['message_body']),
                        'g-recaptcha-response' => e($input_data['g-recaptcha-response'])
            ];

            //validate user data
            $validator = Validator::make($user_data, $rules, $messages);

            //check if csrf token is valid
            if(Session::token() != $token){
                return Response::json(['status' => 'error',
                                        'errors' => 'Nevažeći CSRF token!'
                ]);
            }
            else {
                //check validation results and save user if ok
                if($validator->fails()){
                    return Response::json(['status' => 'error',
                                            'errors' => $validator->getMessageBag()->toArray()
                    ]);
                }
                else{
                    //send email
                    try{
                        Mail::send('email', $user_data, function($message) use ($user_data){
                            $info_data = Info::first();
                            $message->from($user_data['email'], $user_data['full_name']);
                            $message->to($info_data->owner_contact_email)->subject($info_data->web_email_subject.' - '.$user_data['subject']);
                        });
                        return Response::json(['status' => 'success']);
                    }
                    catch(Exception $e){
                        return Response::json(['status' => 'error',
                                                'errors' => 'E-mail nije mogao biti poslan, pokušajte ponovo'
                        ]);
                    }
                }
            }
        }
        else{
            return Response::json(['status' => 'error',
                                    'errors' => 'Podaci nisu ispravno poslani'
            ]);
        }
    }

    /**
     * show cached rss feed
     * @return mixed
     */
    public function getRss()
    {
        //generate feed and cache for 60 min
        $feed = Feed::make();
        $feed->setCache(60, getenv('RSS_CACHE_KEY'));

        //check if there is cached version
        if(!$feed->isCached()) {
            //grab news data from database
            $news_data = News::orderBy('id', 'DESC')->take(5)->get();
            //check if there are news
            if ($news_data == true) {
                //set feed parameters
                $feed->title = getenv('WEB_NAME').' :: RSS';
                $feed->description = 'Najnovije vijesti na '.getenv('WEB_NAME').'';
                $feed->logo = URL::to('css/assets/images/logo_main_small.png');
                $feed->link = URL::to('rss');
                $feed->setDateFormat('datetime');
                $feed->pubdate = $news_data[0]->created_at;
                $feed->lang = getenv('APP_LOCALE');
                $feed->setShortening(true);
                $feed->setTextLimit(500);
                foreach ($news_data as $news) {
                    $feed->add($news->news_title, 'admin', URL::to(route('news-show', $news->slug)), $news->created_at, (new BBCParser)->unparse($news->news_body), '');
                }
            }
            else{
                return Redirect::to(route('news'))->withErrors('Trenutno nema vijesti. RSS je isključen.');
            }
        }

        return $feed->render('atom');
    }

    /**
     * show all tags
     * @return mixed
     */
    public function showTagsList()
    {
        $tags_data = Tag::all();

        return View::make('public.tags-list')->with(['page_title' => 'Lista tagova',
                                                'tags_data' => $tags_data
        ]);
    }

    /**
     * show news
     * @return mixed
     */
    public function showNews()
    {
        //default form sort value
        $news_text_sort = null;
        $sort_category = null;
        $sort_data = $this->sort_data;
        $news_data = News::orderBy('id', 'DESC')->paginate($this->news_paginate);

        // get top 5 news for mini posts - by num of visits
        $top_news_data = News::orderBy('num_visited', 'DESC')->limit(5)->get();

        return View::make('public.news')->with(['page_title' => 'Obavijesti',
                                            'news_text_sort' => $news_text_sort,
                                            'sort_data' => $sort_data,
                                            'sort_category' => $sort_category,
                                            'news_data' => $news_data,
                                            'top_news_data' => $top_news_data
        ]);
    }
}
