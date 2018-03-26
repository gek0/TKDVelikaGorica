<?php

class Notification extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   title VARCHAR(255)
     *  -   body TEXT
     *  -   enabled ENUM ('yes', 'no') DEFAULT 'no'
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['body' => 'required',
                            'title' => 'required',
                            'enabled' => 'in:yes,no'
    ];

    /**
     * validation error messages
     */
    public static $messages = ['title.required' => 'Naslov ne može biti prazan',
                                'body.required' => 'Tekst ne može biti prazan',
                                'enabled.in' => 'Nije odabran važeći odgovor za status'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications';

}