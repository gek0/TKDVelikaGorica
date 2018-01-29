<?php

class GalleryImage extends Eloquent{

    /**
     * Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	file_name VARCHAR(255) / UNIQUE
     *  -   file_size DOUBLE
     *  -   gallery_id INT UNSIGED / FOREIGN KEY@gallery / ON DELETE CASCADE
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * validation rules for entities
     *
     */
    public static $rules = ['images_name' => 'image|max:6000'];

    /**
     * validation error messages
     */
    public static $messages = ['images.image' => 'Dozvoljeni formati slike su: .jpeg, .png, .bmp i .gif',
                                'images.max' => 'Maksimalna velièina slike je 6MB',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gallery_images';

    /**
     * define relationships
     */
    public function gallery()
    {
        return $this->belongsTo('Gallery', 'gallery_id');
    }
}