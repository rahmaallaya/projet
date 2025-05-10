<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AIServicesController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ProfileController;
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
    return view('Home');
})->name('home');


Route::get('/services/corporate', [ServiceController::class, 'corporateList'])->name('services.corporate.list');
Route::get('/services/individual', [ServiceController::class, 'individualList'])->name('services.individual.list');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'create'])->name('contact.form');
    Route::post('/', [ContactController::class, 'store'])->name('contact.submit');
    Route::get('/list', [ContactController::class, 'index'])->name('contact.requests'); // Pour l'admin
});


    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/contact-requests', [ContactController::class, 'index'])->name('contact-requests.index');
    Route::get('/contact-requests/{id}', [ContactController::class, 'show'])->name('contact-requests.show');
    Route::post('/contact-requests/{id}/response', [ContactController::class, 'response'])->name('contact-requests.response');
    Route::delete('/contact-requests/{id}', [ContactController::class, 'destroy'])->name('contact-requests.destroy');
// Approval Routes (Super Admin)

    Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
    Route::get('/approvals/{id}', [ApprovalController::class, 'show'])->name('approvals.show');
    Route::post('/approvals/approve/{id}', [ApprovalController::class, 'approve'])->name('approvals.approve');
   Route::post('/approvals/reject/{id}', [ApprovalController::class, 'reject'])->name('approvals.reject');

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/ai-services', [AIServicesController::class, 'show'])->name('ai-services');
Route::post('/ai-services/chat', [AIServicesController::class, 'chat'])->name('ai-services.chat');
// routes/web.php

Route::get('/categories/{category}/individual', [ServiceController::class, 'showIndividualPrestataires'])->name('categories.individual.prestataires');
Route::get('/categories/{category}/corporate', [ServiceController::class, 'showCorporatePrestataires'])->name('categories.corporate.prestataires');


// Edition de profil
Route::middleware(['auth.session'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Demandes de service

    Route::prefix('services')->group(function () {
        Route::get('/my-requests', [RequestController::class, 'index'])->name('service.requests');
        Route::post('/request/{prestataire}', [RequestController::class, 'store'])->name('requests.store');
    });

Route::get('/categories/{category}/prestataires', [ServiceController::class, 'showPrestataires'])
     ->name('categories.prestataires');
     