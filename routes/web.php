<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class,'index'])->name('home.index');
Route::get('/events/search', [HomeController::class, 'search'])->name('events.search');
Route::resource('events', HomeController::class);



/* user routes */

Route::resource('reservations', ReservationController::class);

Route::get('profile',function (){
    return view('organizer.dashboard');
});

Route::group(['prefix' => 'organizer', 'as' => 'organizer.', 'namespace' => 'App\Http\Controllers\organizer', 'middleware' => ['auth','organizer']], function () {
    Route::resource('dashboard','DashboardController');
    Route::resource('events','EventController');   
    Route::resource('reservation','ReservationController');   
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'App\Http\Controllers\user', 'middleware' => ['auth', 'user']], function () {
    Route::resource('events','EventController');   
    Route::resource('reservation','ReservationController'); 
    Route::resource('profile','ProfileController');
});
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('categories','CategoryController');   
    Route::resource('events','EventController');   
    Route::resource('reservations','ReservationController'); 
    Route::resource('users','UserController');

    Route::put('users/{user}/update-role', 'UserController@updateRole')->name('users.updateRole');
    Route::get('users/{user}/ban', 'UserController@banUser')->name('users.banUser');
    Route::get('users/{user}/unban', 'UserController@unbanUser')->name('users.unbanUser');
    Route::put('events/{event}/status', 'EventController@updateStatus')->name('events.updateStatus');
});

//Route::get('/events/search', 'HomeController@search')->name('events.search');


