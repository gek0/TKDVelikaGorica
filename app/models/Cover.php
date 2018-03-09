<?php

class Cover extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   cover_title VARCHAR(255)
     *  -   cover_subtitle VARCHAR(255)
     *  -   cover_logo ENUM ('yes', 'no')
     *  -   cover_file VARCHAR(255)
     *  -   cover_type ENUM ('image', 'video')
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['cover_title' => 'between:0,255',
                            'cover_subtitle' => 'between:0,255',
                            'cover_logo' => 'required|in:yes,no'
    ];

    /**
     * validation error messages
     */
    public static $messages = ['cover_title.between' => 'Naslov mora biti kraći od 255 znakova',
                                'cover_subtitle.between' => 'Podnaslov mora biti kraći od 255 znakova',
                                'cover_logo.required' => 'Odabir prikaza logotipa je obavezan',
                                'cover_logo.in' => 'Nije odabran važeći odabir za prikaz logotipa',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cover';

}