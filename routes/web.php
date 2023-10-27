<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\UserController;
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

    // home page
    Route::get('/', function () {
        return Inertia::render('Home');
    });

    // person routes
    Route::prefix('person')->group(function() {
        Route::get('/all', [PersonController::class, 'index']);
        Route::get('/create', [PersonController::class,'createPersonPage']);
        Route::post('/', [PersonController::class, 'store'])->name('store-person');
        Route::get('/edit/{id}', [PersonController::class, 'show'])->name('edit-person');
        Route::put('/edit/{id}', [PersonController::class, 'update'])->name('update-person');
        Route::delete('/delete/{id}', [PersonController::class, 'destroy'])->name('destroy-person');
    });

    // protocol routes
    Route::prefix('protocol')->group(function() {
        Route::get('/all', [ProtocolController::class, 'index']);
        Route::get('/create', [ProtocolController::class,'createProtocolPage']);
        Route::post('/', [ProtocolController::class, 'store'])->name('store-protocol');
        Route::get('/edit/{id}', [ProtocolController::class, 'show'])->name('edit-protocol');
        Route::put('/edit/{id}', [ProtocolController::class, 'update'])->name('update-protocol');
        Route::delete('/delete/{id}', [ProtocolController::class, 'destroy'])->name('destroy-protocol');
    });
    
    // user routes
    Route::prefix('user')->group(function() {
        Route::get('/all', [UserController::class, 'index'])->can('view', 'App\Models\User');
        Route::get('/create',[UserController::class, 'createUserPage'] )->can('view', 'App\Models\User');
        Route::post('/', [UserController::class, 'store'])->name('store-user');
        Route::get('/edit/{id}', [UserController::class, 'show'])->name('edit-user');
        Route::put('/edit/{id}', [UserController::class, 'update'])->name('update-user');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy-user');
    });

    // department routes
    Route::prefix('department')->group(function() {
        Route::get('/all', [DepartmentController::class, 'index'])->can('view', 'App\Models\User');
        Route::get('/create',[DepartmentController::class, 'createDepartmentPage'])->can('view', 'App\Models\User');;
        Route::post('/', [DepartmentController::class, 'store'])->name('store-department');
        Route::get('/show/{id}', [DepartmentController::class, 'show'])->name('show-department');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit-department');
        Route::put('/edit/{id}', [DepartmentController::class, 'update'])->name('update-department');
        Route::delete('/delete/{id}', [DepartmentController::class, 'destroy'])->name('destroy-department');
        Route::post('/add-user', [DepartmentController::class, 'addUser'])->name('add-user-to-department');
        Route::delete('/remove-user', [DepartmentController::class, 'removeUser'])->name('remove-user-from-department');
    });

    // follow up routes
    Route::prefix('follow-up')->group(function() {
        Route::get('/all', [FollowUpController::class, 'index']);
        Route::post('/', [FollowUpController::class, 'store'])->name('store-followUp');
        Route::get('/edit/{id}', [FollowUpController::class, 'show'])->name('edit-followUp');
        Route::put('/edit/{id}', [FollowUpController::class, 'update'])->name('update-followUp');
        Route::delete('/delete/{id}', [FollowUpController::class, 'destroy'])->name('destroy-followUp');
    });
});

