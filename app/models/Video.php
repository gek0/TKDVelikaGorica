<?php

class Video extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	video_url VARCHAR(255)
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['video_url' => 'required|max:11'];

    /**
     * validation error messages
     */
    public static $messages = ['video_url.required' => 'Video URL je obavezan',
                                'video_url.max' => 'Maksimalna duljina URL-a je 11 znakova',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'videos';


}