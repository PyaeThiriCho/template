<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[App\Http\Controllers\TemplateController::class, 'index'])->name('home');
Route::get('/about',[App\Http\Controllers\TemplateController::class, 'about'])->name('about');
Route::get('/contact',[App\Http\Controllers\TemplateController::class, 'contact'])->name('contact');


//category routes
Route::resource('categories',CategoryController::class);


Route::get('/',[App\Http\Controllers\AdminTemplateController::class, 'index'])->name('index');
Route::get('/layoutstat',[App\Http\Controllers\AdminTemplateController::class, 'layoutstat'])->name('layoutstat');
Route::get('/layoutsidenavs',[App\Http\Controllers\AdminTemplateController::class, 'layoutsidenav'])->name('layoutsidenavs');
Route::get('/login',[App\Http\Controllers\AdminTemplateController::class, 'login'])->name('login');
Route::get('/register',[App\Http\Controllers\AdminTemplateController::class, 'register'])->name('register');
Route::get('/password',[App\Http\Controllers\AdminTemplateController::class, 'password'])->name('password');
Route::get('/errors',[App\Http\Controllers\AdminTemplateController::class, 'error'])->name('errors');
Route::get('/charts',[App\Http\Controllers\AdminTemplateController::class, 'chart'])->name('charts');
Route::get('/tables',[App\Http\Controllers\AdminTemplateController::class, 'table'])->name('tables');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users',UserController::class);

//permission
Route::resource('permissions',PermissionController::class);

//role
Route::resource('roles',RoleController::class);