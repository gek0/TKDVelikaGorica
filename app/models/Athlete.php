<?php

class Athlete extends Eloquent{

	/**
	 * Database Model
	 * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
	 *  -   athlete_full_name VARCHAR(255)
	 *  -   athlete_description TEXT
	 *  -	athlete_profile_image VARCHAR(255)
	 * 	-	athlete_birth_date DATETIME
	 *  -   athlete_type ENUM (coach/athlete)
	 *  -   athlete_gender ENUM (male/female)
	 *  -   athlete_trophy ENUM (bronze/silver/gold)
	 *  - 	created_at TIMESTAMP
	 *  - 	updated_at TIMESTAMP
	 */

	/**
	 * validation rules for entities
	 *
	 */
	public static $rules = ['athlete_full_name' => 'required|between:1,255',
							'athlete_profile_image' => 'image|max:3000',
							'athlete_birth_date' => 'date',
							'athlete_type' => 'required|in:coach,athlete',
							'athlete_gender' => 'required|in:male,female',
							'athlete_trophy' => 'in:bronze,silver,gold',
	];

	/**
	 * validation error messages
	 */
	public static $messages = ['athlete_full_name.required' => 'Ime i prezime trenera/sportaša je obavezno',
								'athlete_full_name.between' => 'Ime i prezime trenera/sportaša moraju biti kraći od 255 znakova',
								'athlete_profile_image.image' => 'Dozvoljeni formati slike su: .jpeg, .png, .bmp i .gif',
								'athlete_profile_image.max' => 'Maksimalna veličina slike je 3MB',
								'athlete_birth_date.required' => 'Datum nije u važećem formatu.',
								'athlete_gender.required' => 'Spol trenera/sportaša je obavezan',
								'athlete_gender.in' => 'Spol trenera/sportaša mora biti jedan od ponuđenih: muški ili ženski',
								'athlete_trophy.in' => 'Postignuće trenera/sportaša mora biti jednog od ponuđenih: bronca, srebro ili zlato',
	];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'athletes';

	/**
	 * added functions
	 */
	public function getBirthDateFormated()
	{
		return date('d.m.Y.', strtotime($this->athlete_birth_date));
	}

}