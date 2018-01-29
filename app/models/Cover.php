<?php

class Cover extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   cover_title VARCHAR(255)
     *  -   cover_subtitle VARCHAR(255)
     *  -	cover_file_name VARCHAR(255)
     *  -   cover_file_size DOUBLE
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['cover_title' => 'between:0,255',
                            'cover_subtitle' => 'between:0,255',
                            'cover_file_name' => 'image|max:3000'
    ];

    /**
     * validation error messages
     */
    public static $messages = ['cover_title.between' => 'Naslov mora biti kraći od 255 znakova',
                                'cover_subtitle.between' => 'Podnaslov mora biti kraći od 255 znakova',
                                'cover_file_name.image' => 'Dozvoljeni formati slike su: .jpeg, .png, .bmp i .gif',
                                'cover_file_name.max' => 'Maksimalna veličina slike je 3MB',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cover';

}