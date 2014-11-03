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




/*
 |--------------------------------------------------------------------------
 | Registry the Home Page.
 |--------------------------------------------------------------------------
 */
Route::get('/', 'HomeController@showWelcome');


/*
 |--------------------------------------------------------------------------
 | Registry Help Page
 |--------------------------------------------------------------------------
 */
Route::get('help/{about}', function($about){
	return HelpController::help($about);
})->where('about', 'font|fbstatus');


/*
 |--------------------------------------------------------------------------
 | Registry Phonetic Rupantor and Keymaps.
 |--------------------------------------------------------------------------
 */
$allPhoneticConverterVersionNames = 'basic|dhusor|shobdopata|shuvro';

Route::any('{version}', function($version){
	return PhoneticController::rupantor($version);
})->where('version', $allPhoneticConverterVersionNames);

Route::get('keymap/{version}', function($version){
	return KeymapController::view($version);
})->where('version', 'basic|dhusor|shobdopata|shuvro');


/*
 |--------------------------------------------------------------------------
 | Registry Facebook Status Update app.
 |--------------------------------------------------------------------------
 */
Route::any('confirm', 'StatusUpdateController@confirm');

Route::any('update', 'StatusUpdateController@update');


/*
 |--------------------------------------------------------------------------
 | Registry DataBase Maker.
 |--------------------------------------------------------------------------
 */
Route::any('make', 'MakeDatabaseController@insertHashTable');


/*
 |--------------------------------------------------------------------------
 | Registry Sitemap.
 |--------------------------------------------------------------------------
 */
Route::get('sitemap/sitemap.xml', function(){
	return Response::view('sitemaps.sitemap')->header('Content-Type', 'text/xml;charset=utf-8');
});