<?php

class Section extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   section_name VARCHAR(255)
     *  -   enabled ENUM ('yes', 'no')
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['enabled' => 'required|in:yes,no'];

    /**
     * validation error messages
     */
    public static $messages = ['enabled.in' => 'Nije odabran važeći odabir za prikaz sekcije'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sections';

}