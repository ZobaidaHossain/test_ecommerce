<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Define the dashboard route
// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard'); // Replace 'Dashboard' with your Vue component
// })->name('dashboard');


///////////////////////////////
// Route::get('/',function(){
// return view('admin.dashboard');
// })->name('admin.dashboard');



Route::get('/',[AuthController::class,'login']);
Route::post('/',[AuthController::class,'auth_login']);

Route::get('logout',[AuthController::class,'logout']);
// Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');

Route::group(['middleware'=>'useradmin'],function(){

    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');

    Route::resource('role',RoleController::class);

Route::resource('/slider', SliderController::class);
Route::resource('/product',ProductController::class);
Route::resource('/order',OrderController::class);

Route::get('/user',[UserController::class,'list'])->name('user.list');
Route::get('/user/add',[UserController::class,'add'])->name('user.add');
Route::post('/user/add',[UserController::class,'insert'])->name('user.insert');
Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('user.edit');
Route::post('/user/edit/{id}',[UserController::class,'update'])->name('user.update');
Route::get('/user/delete/{id}',[UserController::class,'delete'])->name('user.delete');
});

