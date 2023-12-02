<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookResourceController;
use App\Http\Controllers\CategoryResourceController;

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

Route::get('/', [PublicController::class, 'index']);


Route::middleware('only_guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registerProcess']);
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('only_admin');
    Route::get('/profile', [UserController::class, 'profile'])->middleware('only_client');


    Route::get('/logout', [AuthController::class, 'logout']);

    Route::middleware('only_admin')->group(function () {
        Route::get('/books/checkSlug', [BookResourceController::class, 'checkSlug']);
        Route::resource('/books', BookResourceController::class)->except('show');
        Route::get('/books/deleted', [BookController::class, 'deletedBooks']);
        Route::get('/books/restore/{slug}', [BookController::class, 'restore']);
        // Route::get('/books', [BookController::class, 'index']);

        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/registered', [UserController::class, 'registered']);
        Route::get('/users/detail/{slug}', [UserController::class, 'show']);
        Route::get('/users/approve/{slug}', [UserController::class, 'approve']);
        Route::get('/users/ban/{slug}', [UserController::class, 'destroy']);
        Route::get('/users/banned/', [UserController::class, 'banned']);
        Route::get('/users/restore/{slug}', [UserController::class, 'restore']);

        Route::get('/categories/checkSlug', [CategoryResourceController::class, 'checkSlug']);
        Route::resource('/categories', CategoryResourceController::class)->except('show');
        Route::get('/categories/deleted', [CategoryController::class, 'deletedCategory']);
        Route::get('/categories/restore/{slug}', [CategoryController::class, 'restore']);
        Route::get('/bookRent', [BookRentController::class, 'index']);
        Route::post('/bookRent', [BookRentController::class, 'store']);

        Route::get('/rent-logs', [RentLogController::class, 'index']);
        Route::get('/bookReturn', [BookRentController::class, 'returnBook']);
        Route::post('/bookReturn', [BookRentController::class, 'storeBook']);
    });
});
