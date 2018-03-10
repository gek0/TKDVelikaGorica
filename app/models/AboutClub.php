<?php

class AboutClub extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   about_title VARCHAR(255)
     *  -   about_body TEXT
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['about_body' => 'required',
                            'about_title' => 'required'
    ];

    /**
     * validation error messages
     */
    public static $messages = ['about_title.required' => 'Naslov ne može biti prazan',
                                'about_body.required' => 'Tekst ne može biti prazan'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'about_club';

}