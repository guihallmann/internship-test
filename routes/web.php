<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProtocolController;
use App\Models\Person;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
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


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
});

Route::post('/login', [LoginController::class, 'store'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {
    // get home page
    Route::get('/', function () {
        return Inertia::render('Home');
    });
    // get all people
    Route::get('/people', [PersonController::class, 'index']);
    // get create person page
    Route::get('/create-person', function () {
        return Inertia::render('CreatePerson');
    });
    // create person
    Route::post('/person', [PersonController::class, 'store'])->name('person');
    // get update person page
    Route::get('/edit-person/{id}', [PersonController::class, 'show'])->name('edit-person');
    // update person
    Route::put('/edit-person/{id}', [PersonController::class, 'update'])->name('edit-person');
    // delete person
    Route::delete('/delete-person/{id}', [PersonController::class, 'destroy'])->name('delete-person');

    // get all protocols
    Route::get('/protocols', [ProtocolController::class, 'index']);
    // get create protocol page
    Route::get('/create-protocol', function () {
        return Inertia::render('CreateProtocol', ['people' => Person::all()]);
    });
    // create protocol
    Route::post('/protocol', [ProtocolController::class, 'store'])->name('protocol');
    // get update protocol page
    Route::get('/edit-protocol/{id}', [ProtocolController::class, 'show'])->name('edit-protocol');
    // update protocol
    Route::put('/edit-protocol/{id}', [ProtocolController::class, 'update'])->name('edit-protocol');
    // delete protocol
    Route::delete('/delete-protocol/{id}', [ProtocolController::class, 'destroy'])->name('delete-protocol');
});

