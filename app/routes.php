<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * admin area
 */
Route::group(['before' => 'auth'], function() {
	Route::get('admin', function(){
		return Redirect::to(route('admin-page-home'));
	});

	Route::group(['prefix' => 'admin'], function() {
		Route::get('naslovnica', ['as' => 'admin-page-home', 'uses' => 'AdminController@showPageHome']);
		Route::post('naslovnica', ['as' => 'admin-cover-editPOST', 'uses' => 'AdminController@updateCover']);

		Route::get('o-nama', ['as' => 'admin-about-us', 'uses' => 'AdminController@showAboutUs']);
		Route::post('o-nama', ['as' => 'admin-about-usPOST', 'uses' => 'AdminController@updateAboutUs']);

		Route::get('obavijesti', ['as' => 'admin-news', 'uses' => 'NewsController@showNews']);
		Route::get('obavijesti/nova', ['as' => 'admin-news-add', 'uses' => 'NewsController@showNewNewsForm']);
		Route::post('obavijesti/nova', ['as' => 'admin-news-addPOST', 'uses' => 'NewsController@addNewNews']);
		Route::get('obavijesti/pregled/{slug}', ['as' => 'admin-news-show', 'uses' => 'NewsController@showIndividualNews'])->where(['slug' => '[\w\-šđčćžŠĐČĆŽ]+']);
		Route::get('obavijesti/izmjena/{slug}', ['as' => 'admin-news-edit', 'uses' => 'NewsController@showNewsEditForm'])->where(['slug' => '[\w\-šđčćžŠĐČĆŽ]+']);
		Route::post('obavijesti/izmjena/{slug}', ['as' => 'admin-news-editPOST', 'uses' => 'NewsController@updateNews'])->where(['slug' => '[\w\-šđčćžŠĐČĆŽ]+']);
		Route::get('obavijesti/brisanje/{slug}', ['as' => 'admin-news-delete', 'uses' => 'NewsController@deleteNews'])->where(['slug' => '[\w\-šđčćžŠĐČĆŽ]+']);
		Route::get('obavijesti/brisanje-slike-obavijesti/{id}', ['as' => 'admin-news-gallery-image-delete', 'uses' => 'NewsController@deleteNewsGalleryImage'])->where(['id' => '[0-9]+']);

		Route::get('kalendar', ['as' => 'admin-calendar', 'uses' => 'EventController@showCalendar']);
		Route::post('kalendar', ['as' => 'admin-calendarPOST', 'uses' => 'EventController@addEventToCalendar']);
		Route::post('kalendar-izmjena', ['as' => 'admin-event-editPOST', 'uses' => 'EventController@updateEvent']);
		Route::get('kalendar/izmjena/{id}', ['as' => 'admin-event-edit', 'uses' => 'EventController@showUpdateEvent'])->where(['id' => '[0-9]+']);
		Route::get('kalendar-brisanje/{id}', ['as' => 'admin-event-delete', 'uses' => 'EventController@deleteEvent'])->where(['id' => '[0-9]+']);

		Route::get('galerija', ['as' => 'admin-image-galleries', 'uses' => 'GalleryController@showImageGalleries']);
		Route::post('galerija', ['as' => 'admin-image-galleriesPOST', 'uses' => 'GalleryController@createImageGallery']);
		Route::get('galerija/pregled/{slug}', ['as' => 'admin-image-gallery-view', 'uses' => 'GalleryController@viewImageGallery'])->where(['slug' => '[\w\-šđčćžŠĐČĆŽ]+']);
		Route::post('galerija/izmjena', ['as' => 'admin-image-gallery-editPOST', 'uses' => 'GalleryController@editImageGallery']);
		Route::get('galerija-brisanje-slike/{id}', ['as' => 'admin-image-gallery-image-delete', 'uses' => 'GalleryController@deleteImageGalleryImage'])->where(['id' => '[0-9]+']);
		Route::get('galerija-brisanje-galerije/{id}', ['as' => 'admin-image-gallery-delete', 'uses' => 'GalleryController@deleteImageGallery'])->where(['id' => '[0-9]+']);

		Route::post('video-galerija', ['as' => 'admin-video-galleryPOST', 'uses' => 'GalleryController@addVideoToGallery']);
		Route::get('video-galerija', ['as' => 'admin-video-gallery', 'uses' => 'GalleryController@showVideoGallery']);
		Route::get('video-galerija-brisanje/{id}', ['as' => 'admin-video-gallery-delete', 'uses' => 'GalleryController@deleteVideoGalleryUrl'])->where(['id' => '[0-9]+']);

		Route::post('sportasi', ['as' => 'admin-athletesPOST', 'uses' => 'AthleteController@addAthlete']);
		Route::get('sportasi', ['as' => 'admin-athletes', 'uses' => 'AthleteController@showAthletes']);
		Route::post('sportasi-izmjena', ['as' => 'admin-athletes-editPOST', 'uses' => 'AthleteController@updateAthlete']);
		Route::get('sportasi/izmjena/{id}', ['as' => 'admin-athletes-edit', 'uses' => 'AthleteController@showUpdateAthlete'])->where(['id' => '[0-9]+']);
		Route::get('sportasi-brisanje/{id}', ['as' => 'admin-athletes-delete', 'uses' => 'AthleteController@deleteAthlete'])->where(['id' => '[0-9]+']);

		Route::post('info', ['as' => 'admin-infoPOST', 'uses' => 'AdminController@updateInfo']);
		Route::get('info', ['as' => 'admin-info', 'uses' => 'AdminController@showInfo']);

		Route::post('korisnici', ['as' => 'admin-usersPOST', 'uses' => 'UserController@addUser']);
		Route::get('korisnici', ['as' => 'admin-users', 'uses' => 'UserController@showUsers']);
		Route::post('korisnici-izmjena', ['as' => 'admin-users-editPOST', 'uses' => 'UserController@updateUser']);
		Route::get('korisnici/izmjena/{id}', ['as' => 'admin-users-edit', 'uses' => 'UserController@showUpdateUser'])->where(['id' => '[0-9]+']);
		Route::get('korisnici-brisanje/{id}', ['as' => 'admin-users-delete', 'uses' => 'UserController@deleteUser'])->where(['id' => '[0-9]+']);
	});
});

/**
 * logout from admin area
 */
Route::get('odjava', function(){
	Auth::logout();
	return Redirect::to(route('home'));
});

/**
 * public area
 */
Route::post('prijava', ['as' => 'loginPOST', 'uses' => 'LoginController@checkLogin']);
Route::get('prijava', ['as' => 'login', 'uses' => 'LoginController@showLogin']);
Route::get('obavijesti', ['as' => 'news', 'uses' => 'PublicController@showNews']);
Route::get('obavijesti/sortirano', ['as' => 'news-sort', 'uses' => 'PublicController@showFilteredSortedNews']);
Route::get('obavijesti/pregled/{slug}', ['as' => 'news-show', 'uses' => 'PublicController@showIndividualNews'])->where(['slug' => '[\w\-šðèæžŠÐÈÆŽ]+']);
Route::get('galerije', ['as' => 'galleries', 'uses' => 'PublicController@showGalleries']);
Route::get('galerije/pregled/{slug}', ['as' => 'image-gallery-view', 'uses' => 'PublicController@viewImageGallery'])->where(['slug' => '[\w\-šđčćžŠĐČĆŽ]+']);
Route::get('rss', ['as' => 'rss', 'uses' => 'PublicController@getRss']);
Route::get('kontakt', ['as' => 'contact', 'uses' => 'PublicController@showContact']);
Route::post('kontakt', ['as' => 'contactPOST', 'uses' => 'PublicController@sendMail']);
Route::get('/', ['as' => 'home', 'uses' => 'PublicController@showHome']);