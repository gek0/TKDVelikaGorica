<?php

class CalendarEvent extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   event_title VARCHAR(255)
     *  -   start_time DATETIME
     *  -	end_time DATETIME
     *  -   event_url VARCHAR(255)
     *  -   event_color VARCHAR(10)
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['event_title' => 'required|between:1,255',
                            'start_time' => 'required|date',
                            'end_time' => 'required|date',
                            'event_url' => 'url|between:0,255',
                            'event_color' => 'between:0,10'
    ];

    /**
     * validation error messages
     */
    public static $messages = ['event_title.required' => 'Naslov eventa je obavezan',
                                'event_title.between' => 'Naslov eventa mora biti kraći od 255 znakova',
                                'start_time.required' => 'Datum početka eventa je obavezan',
                                'start_time.date' => 'Datum početka eventa nije važeći',
                                'end_time.required' => 'Datum završetka eventa je obavezan',
                                'end_time.date' => 'Datum završetka eventa nije važeći',
                                'event_url.url' => 'URL eventa nije važeći',
                                'event_url.between' => 'URL eventa mora biti kraći od 255 znakova',
                                'event_color.between' => 'Kod boje eventa mora biti kraći od 10 znakova',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * added functions
     */
    public function getStartTimeFormated()
    {
        return date('d.m.Y.', strtotime($this->start_time));
    }

    public function getEndTimeFormated()
    {
        return date('d.m.Y.', strtotime($this->end_time));
    }

}