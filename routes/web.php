<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TemplateController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/favicon', function () {
//     $theme = session('theme', 'light'); // Contoh: mengambil tema dari session
//     $path = public_path("foto/favicon-{$theme}.ico");
//     return response()->file($path);
// });

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/program-detail/{slug}', [HomeController::class, 'program'])->name('program.show');
Route::get('/blog-detail/{slug}', [HomeController::class, 'blog'])->name('blog.show');
Route::get('/blog-all', [HomeController::class, 'blog_all'])->name('blog.all');

Route::get('/mail', [MailController::class, 'mail'])->name('mail')->middleware('auth');
Route::get('/mail/{id}/mark-as-read', [MailController::class, 'markAsRead'])->name('mail.markAsRead');
Route::post('/mail-insert', [MailController::class, 'insert'])->name('mail.insert');
Route::get('/mail-delete/{id}', [MailController::class, 'delete'])->name('mail.delete');




Route::get('/backoffice', [GeneralController::class, 'backoffice'])->name('backoffice');
Route::put('/update-general', [GeneralController::class, 'update'])->name('update.general');

Route::get('/content-general', [ContentController::class, 'content'])->name('content.general');
Route::get('/content-tambah', [ContentController::class, 'tambah'])->name('content.tambah');
Route::post('/content-insert', [ContentController::class, 'insert'])->name('content.insert');
Route::get('/content-delete/{id}', [ContentController::class, 'delete'])->name('content.delete');
Route::get('/content-edit/{id}', [ContentController::class, 'edit'])->name('content.edit');
Route::post('/content-update/{id}', [ContentController::class, 'update'])->name('content.update');

Route::get('/backoffice/program/checkSlug', [ProgramController::class, 'checkSlug'])->name('checkSlug');
Route::get('/program', [ProgramController::class, 'program'])->name('program');
Route::get('/program-tambah', [ProgramController::class, 'tambah'])->name('program.tambah');
Route::post('/program-insert', [ProgramController::class, 'insert'])->name('program.insert');
Route::get('/program-delete/{id}', [ProgramController::class, 'delete'])->name('program.delete');
Route::get('/program-edit/{id}', [ProgramController::class, 'edit'])->name('program.edit');
Route::post('/program-update/{id}', [ProgramController::class, 'update'])->name('program.update');

Route::get('/review', [ReviewController::class, 'review'])->name('review');
Route::get('/review-tambah', [ReviewController::class, 'tambah'])->name('review.tambah');
Route::post('/review-insert', [ReviewController::class, 'insert'])->name('review.insert');
Route::get('/review-delete/{id}', [ReviewController::class, 'delete'])->name('review.delete');
Route::get('/review-edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
Route::post('/review-update/{id}', [ReviewController::class, 'update'])->name('review.update');

Route::get('/backoffice/blog/checkSlug', [BlogController::class, 'checkSlug'])->name('checkSlug');
Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
Route::get('/blog-tambah', [BlogController::class, 'tambah'])->name('blog.tambah');
Route::post('/blog-insert', [BlogController::class, 'insert'])->name('blog.insert');
Route::get('/blog-delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
Route::get('/blog-edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
Route::post('/blog-update/{id}', [BlogController::class, 'update'])->name('blog.update');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::get('/search-contact', [ContactController::class, 'search'])->name('search.contact');
Route::get('/contact-tambah', [ContactController::class, 'tambah'])->name('contact.tambah');
Route::post('/contact-insert', [ContactController::class, 'insert'])->name('contact.insert');
Route::get('/contact-delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');
Route::get('/contact-edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
Route::post('/contact-update/{id}', [ContactController::class, 'update'])->name('contact.update');


Route::get('/login-backoffice', [LoginController::class, 'login'])->name('login.backoffice');
Route::post('/login-proses', [LoginController::class, 'proses'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');































