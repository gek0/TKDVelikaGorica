<?php


class EventController extends BaseController
{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }


    /**
     * show admin calendar
     * @return mixed
     */
    public function showCalendar()
    {
        $events = CalendarEvent::get();
        $events_data = [];

        foreach($events as $e){
            $events_data[] = Calendar::event(cro_name_strings($e->event_title), true, $e->start_time, $e->end_time, $e->id,
                                            ['url' => $e->event_url, 'color' => $e->event_color, 'textColor' => '#FFFFFF']
            );
        }

        $calendar = Calendar::addEvents($events_data);

        return View::make('admin.calendar.calendar')->with(['page_title' => 'Administracija',
                                                    'events' => $events,
                                                    'calendar' => $calendar
        ]);
    }

    /**
     * add event to calendar
     * @return mixed
     */
    public function addEventToCalendar()
    {
        $form_data = ['event_title' => e(Input::get('event_title')),
                        'start_time' => e(Input::get('start_time')),
                        'end_time' => e(Input::get('end_time')),
                        'event_color' => e(Input::get('event_color')),
                        'event_url' => e(Input::get('event_url'))
        ];
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, CalendarEvent::$rules, CalendarEvent::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            // initialize new model object
            $event = new CalendarEvent;
            $event->event_title = $form_data['event_title'];
            $event->start_time = $form_data['start_time'];
            $event->end_time = $form_data['end_time'];
            $event->event_color = $form_data['event_color'];
            $event->event_url = $form_data['event_url'];
            $event->save();
        }

        return Redirect::to(route('admin-calendar'))->with(['success' => 'Event je uspješno dodan na kalendar']);
    }

    /**
     * show admin event edit
     * @return mixed
     */
    public function showUpdateEvent($id = null)
    {
        if($id == null){
            return Redirect::to(route('admin-calendar'))->withErrors('Event ne postoji');
        }
        else{
            $event = CalendarEvent::where('id', '=', $id)->first();
            if(!$event){
                return Redirect::to(route('admin-calendar'))->withErrors('Event ne postoji');
            }
            else{
                return View::make('admin.calendar.calendar-edit')->with(['page_title' => 'Administracija',
                                                                        'event' => $event
                ]);
            }
        }
    }

    /**
     * update calendar event
     * @return mixed
     */
    public function updateEvent()
    {
        $form_data = ['id' => e(Input::get('id')),
                        'event_title' => e(Input::get('event_title')),
                        'start_time' => e(Input::get('start_time')),
                        'end_time' => e(Input::get('end_time')),
                        'event_color' => e(Input::get('event_color')),
                        'event_url' => e(Input::get('event_url'))
        ];
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token!');
        }

        $validator = Validator::make($form_data, CalendarEvent::$rules, CalendarEvent::$messages);
        //check validation results and category if ok
        if($validator->fails()){
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
        }
        else{
            // initialize new model object
            $event = CalendarEvent::where('id', '=', $form_data['id'])->first();

            $event->event_title = $form_data['event_title'];
            $event->start_time = $form_data['start_time'];
            $event->end_time = $form_data['end_time'];
            $event->event_color = $form_data['event_color'];
            $event->event_url = $form_data['event_url'];
            $event->save();
        }

        return Redirect::to(route('admin-calendar'))->with(['success' => 'Event je uspješno izmjenjen']);
    }

    /**
     * delete event
     * @return mixed
     */
    public function deleteEvent($id = null)
    {
        if($id == null){
            return Redirect::to(route('admin-calendar'))->withErrors('Event ne postoji');
        }
        else{
            $event = CalendarEvent::where('id', '=', $id)->first();
            if(!$event){
                return Redirect::to(route('admin-calendar'))->withErrors('Event ne postoji');
            }
            else{

                try{
                    $event->delete();
                }
                catch(Exception $e){
                    return Redirect::to(route('admin-calendar'))->withErrors('Event nije mogao biti obrisan');
                }

                return Redirect::to(route('admin-calendar'))->with(['success' => 'Event je uspješno obrisan']);
            }
        }
    }
}