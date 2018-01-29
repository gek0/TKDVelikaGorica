<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Gallery extends Eloquent implements SluggableInterface{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	name VARCHAR(255) / UNIQUE
     *  -   slug VARCHAR(255)
     *  -   path VARCHAR(255)
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    use SluggableTrait;

    protected $sluggable = ['build_from' => 'name',
                            'save_to'    => 'slug',
    ];

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['name' => 'required|between:1,255|unique:gallery'];

    /**
     * validation error messages
     */
    public static $messages = ['name.required' => 'Naslov galerije je obavezan',
                                'name.between' => 'Naslov galerije mora biti kraći od 255 znakova',
                                'name.unique' => 'Galerija s istim naslovom već postoji',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'galleries';

    /**
     * define relationships
     */
    public function images()
    {
        return $this->hasMany('GalleryImage', 'gallery_id');
    }

    /**
     * added functions
     */
    public function getDateCreatedFormated()
    {
        return date('d.m.Y. \u H:i\h', strtotime($this->created_at));
    }

    public function getDateCreatedFormatedHTML()
    {
        return date('Y-m-d', strtotime($this->created_at));
    }

}