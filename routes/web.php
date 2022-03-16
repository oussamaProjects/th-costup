<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $password = '123456';
    // $hashedPassword = Hash::make($password);
    // echo $hashedPassword;
    // die;
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',  'App\Http\Controllers\Dashboard@index')->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/settings',  'App\Http\Controllers\Dashboard@settings')->name('settings');
Route::middleware(['auth:sanctum', 'verified'])->get('/calculator',  'App\Http\Controllers\Dashboard@calculator')->name('calculator');
Route::middleware(['auth:sanctum', 'verified'])->get('/neveling',  'App\Http\Controllers\Dashboard@neveling')->name('neveling');

Route::resource('factors', 'App\Http\Controllers\FactorController');

Route::resource('projects', 'App\Http\Controllers\ProjectController');

Route::get('projects/{project}/factors',         'App\Http\Controllers\ProjectController@getProjectFactors')->name('get-project-factors');
Route::get('projects/{project}/factorsNotInProject',         'App\Http\Controllers\ProjectController@getFactorsNotInProject')->name('get-factors-not-in-project');
Route::post('projects/storeProjectFactors',    'App\Http\Controllers\ProjectController@storeProjectFactors')->name('store-project-factors');

Route::get('projects/{project}/values',         'App\Http\Controllers\ProjectController@getProjectValues')->name('get-project-values');
Route::post('projects/storeProjectCategories',  'App\Http\Controllers\ProjectController@storeProjectCategories')->name('store-project-categories');
Route::get('projects/{project}/extras',  'App\Http\Controllers\ProjectController@getProjectExtras')->name('get-project-extras');
Route::post('projects/storeProjectExtras',      'App\Http\Controllers\ProjectController@storeProjectExtras')->name('store-project-extras');


Route::post('projects/storeProjectServices',    'App\Http\Controllers\ProjectController@storeProjectServices')->name('store-project-services');
Route::post('projects/deleteProjectServices',    'App\Http\Controllers\ProjectController@deleteProjectServices')->name('delete-project-services');

Route::post('projects/storeProjectCalculation', 'App\Http\Controllers\ProjectController@storeProjectCalculation')->name('store-project-calculation');

Route::resource('categories', 'App\Http\Controllers\CategoryController');
Route::get('categories/{category}/services', 'App\Http\Controllers\CategoryController@getCategoryServices')->name('get-category-services');

Route::resource('services', 'App\Http\Controllers\ServiceController');
Route::get('services/{services}/selected', 'App\Http\Controllers\ServiceController@getSelectedServices');

Route::get('pdf-generate/{project}', 'App\Http\Controllers\PdfGenerateController@PDFgenerate')->name('generate-pdf');
