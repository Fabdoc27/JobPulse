<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\ResetPassword;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PluginsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Pages
Route::get('/', [PagesController::class, 'homePage'])->name('homepage');
Route::get('/about', [PagesController::class, 'aboutPage'])->name('about');
Route::get('/jobs', [PagesController::class, 'jobPage'])->name('jobs');
Route::get('/job/{job}', [PagesController::class, 'jobDetails'])->name('jobs.details');
Route::get('/blog', [PagesController::class, 'blogPage'])->name('blogs');
Route::get('/blog/{blog}', [PagesController::class, 'blogDetails'])->name('blogs.details');
Route::get('/contact', [PagesController::class, 'contactPage'])->name('contact');
Route::post('/visitor-mail', [PagesController::class, 'visitorMail'])->name('visitor.mail');

// Login routes
Route::view('/owner-login', 'auth.ownerLogin')->name('owner.login');
Route::post('/owner-verify', [LoginController::class, 'ownerLogin'])->name('verify.owner');

Route::view('/company-login', 'auth.companyLogin')->name('company.login');
Route::post('/company-verify', [LoginController::class, 'companyLogin'])->name('verify.company');

Route::view('/candidate-login', 'auth.candidateLogin')->name('candidate.login');
Route::post('/candidate-verify', [LoginController::class, 'candidateLogin'])->name('verify.candidate');

// Register routes
Route::view('/company-register', 'auth.companyRegister')->name('company.register');
Route::post('/company-store', [RegisterController::class, 'companyRegister'])->name('company.store');

Route::view('/candidate-register', 'auth.candidateRegister')->name('candidate.register');
Route::post('/candidate-store', [RegisterController::class, 'candidateRegister'])->name('candidate.store');

// Logout
Route::post('/logout', LogoutController::class)->name('logout');

// Reset Password
Route::view('/reset-password', 'auth.sendOtp')->name('sendOtp');
Route::post('/send-otp', [ResetPassword::class, 'sendOtp'])->name('emailSubmit');
Route::view('/verify-otp', 'auth.verifyOtp')->name('verifyOtp');
Route::post('/check-otp', [ResetPassword::class, 'verifyOtp'])->name('otpSubmit');
Route::view('/new-password', 'auth.newPassword')->name('newPassword');
Route::post('/create-password', [ResetPassword::class, 'newPassword'])->name('passwordSubmit');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'userProfile'])->name('profile');
    Route::post('/owner-update', [ProfileController::class, 'ownerProfileUpdate'])->name('owner.update');
    Route::post('/company-update', [ProfileController::class, 'companyProfileUpdate'])->name('company.update');
    Route::post('/candidate-update', [ProfileController::class, 'candidateProfileUpdate'])->name('candidate.update');

    // Company
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/company/{id}', [CompanyController::class, 'show'])->name('company.show');
    Route::post('/company/status/{id}', [CompanyController::class, 'update'])->name('company.status');
    Route::delete('/company/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');

    // Jobs
    Route::get('/jobs/index', [JobsController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobsController::class, 'create'])->name('jobs.create');
    Route::post('/jobs/store', [JobsController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/edit/{id}', [JobsController::class, 'edit'])->name('jobs.edit');
    Route::get('/jobs/show/{id}', [JobsController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/update/{id}', [JobsController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobsController::class, 'destroy'])->name('jobs.destroy');
    Route::post('/jobs/status', [JobsController::class, 'updateStatus'])->name('jobs.updateStatus');
    Route::get('/jobs/applicants/{id}', [JobsController::class, 'showApplicants'])->name('jobs.applicants');

    // Candidate Apply
    Route::post('/job-apply', [ApplicantController::class, 'apply'])->name('job.apply');
    Route::post('/job-selection', [ApplicantController::class, 'selection'])->name('job.selection');

    // Page Content
    Route::get('/pages/{page}', [PagesController::class, 'page'])->name('page.create');
    Route::post('/pages/store', [PagesController::class, 'pageContent'])->name('page.store');

    // Blogs
    Route::get('/blogs/index', [BlogsController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogsController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogsController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/edit/{id}', [BlogsController::class, 'edit'])->name('blogs.edit');
    Route::get('/blogs/show/{id}', [BlogsController::class, 'show'])->name('blogs.show');
    Route::post('/blogs/update/{id}', [BlogsController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{id}', [BlogsController::class, 'destroy'])->name('blogs.destroy');

    // Plugins
    Route::get('/plugins/index', [PluginsController::class, 'index'])->name('plugin.index');
    Route::get('/plugins/create', [PluginsController::class, 'create'])->name('plugin.create');
    Route::post('/plugins/store', [PluginsController::class, 'store'])->name('plugin.store');
    Route::get('/plugins/edit/{plugin}', [PluginsController::class, 'edit'])->name('plugin.edit');
    Route::post('/plugins/update/{plugin}', [PluginsController::class, 'update'])->name('plugin.update');
    Route::delete('/plugins/{plugin}', [PluginsController::class, 'destroy'])->name('plugin.destroy');
    Route::post('/plugin/status/{plugin}', [PluginsController::class, 'pluginStatus'])->name('plugin.status');
});
