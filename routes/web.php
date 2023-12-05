<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\User\AuthorController as UserAuthorController;
use App\Http\Controllers\Admin\PublisherController as AdminPublisherController;
use App\Http\Controllers\User\PublisherController as UserPublisherController;






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



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Route::resource('publishers', PublisherController::class);
    //Route::resource('books', BookController::class);
    //Route::resource('authors', AuthorController::class);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::resource('/books', UserBookController::class)
    ->middleware(['auth', 'role:user,admin'])
    ->names('user.books')
    ->only(['index', 'show']);

Route::resource('/admin/books', AdminBookController::class)->middleware(['auth', 'role:admin'])->names('admin.books');

Route::resource('/authors', UserAuthorController::class)
    ->middleware(['auth', 'role:user,admin'])
    ->names('user.authors')
    ->only(['index', 'show']);

Route::resource('/admin/authors', AdminAuthorController::class)->middleware(['auth', 'role:admin'])->names('admin.authors');

Route::resource('/publishers', UserPublisherController::class)
    ->middleware(['auth', 'role:user,admin'])
    ->names('user.publishers')
    ->only(['index', 'show']);

Route::resource('/admin/publishers', AdminPublisherController::class)->middleware(['auth', 'role:admin'])->names('admin.publishers');

require __DIR__.'/auth.php';
