<?php

class Info extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   owner_contact_email VARCHAR(255)
     *  -   owner_contact_phone VARCHAR(255)
     *  -	owner_contact_address VARCHAR(255)
     *  -   web_email_subject VARCHAR(255)
     *  -   bank_account VARCHAR(255)
     *  -   iban_number VARCHAR(255)
     *  -   oib_number VARCHAR(255)
     *  -	facebook_url VARCHAR(255)
     *  -   twitter_url VARCHAR(255)
     *  -   youtube_url VARCHAR(255)
     *  -   map_lat FLOAT(10,6) UNSIGNED
     *  -   map_lng FLOAT(10,6) UNSIGNED
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = [];

    /**
     * validation error messages
     */
    public static $messages = [];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'info';

}