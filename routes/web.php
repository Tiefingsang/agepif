<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SlideController as AdminSlideController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PropertyController as FrontPropertyController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\RentalRequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Routes Frontend (Publiques)
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages statiques
Route::get('/a-propos', function () {
    return view('front.about');
})->name('about');

Route::get('/contact', function () {
    return view('front.contact');
})->name('contact');

// Biens immobiliers
Route::prefix('biens')->name('properties.')->group(function () {
    Route::get('/', [FrontPropertyController::class, 'index'])->name('index');
    Route::get('/{slug}', [FrontPropertyController::class, 'show'])->name('show');
});

// Demandes de location
Route::prefix('location')->name('rental-request.')->group(function () {
    Route::get('/{property}', [RentalRequestController::class, 'create'])->name('create');
    Route::post('/', [RentalRequestController::class, 'store'])->name('store');
});

// Services
Route::get('/services', function () {
    return view('front.services');})->name('services');

// Formulaire de contact
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::post('/contact/property/{propertyId}', [ContactController::class, 'propertyInquiry'])->name('contact.property');

/*
|--------------------------------------------------------------------------
| Routes d'authentification
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();
        return redirect()->intended('admin');
    }

    return back()->withErrors([
        'email' => 'Les identifiants sont incorrects.',
    ])->onlyInput('email');
})->name('login.post');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Route d'inscription (si vous voulez permettre l'inscription)
/* Route::get('/register', function () {
    return view('auth.register');
})->name('register'); */

Route::post('/register', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => 'user',
    ]);

    Auth::login($user);
    return redirect()->route('home');
})->name('register.post');

/*
|--------------------------------------------------------------------------
| Routes Admin (Protégées)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des biens
    Route::resource('properties', AdminPropertyController::class);
    Route::get('properties/{property}/toggle-featured', [AdminPropertyController::class, 'toggleFeatured'])->name('properties.toggle-featured');

    // Gestion des demandes
    Route::resource('inquiries', InquiryController::class);
    Route::post('inquiries/bulk-delete', [InquiryController::class, 'bulkDelete'])->name('inquiries.bulk-delete');
    Route::post('inquiries/bulk-contacted', [InquiryController::class, 'bulkContacted'])->name('inquiries.bulk-contacted');
    Route::get('inquiries/export-excel', [InquiryController::class, 'exportExcel'])->name('inquiries.export-excel');
    Route::get('inquiries/export-pdf', [InquiryController::class, 'exportPdf'])->name('inquiries.export-pdf');

    // Gestion des catégories
    Route::resource('categories', CategoryController::class);

    // Gestion des slides
    Route::resource('slides', AdminSlideController::class);

    // Gestion des utilisateurs
    Route::resource('users', UserController::class);

    // Paramètres
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    // Gestion des clients
    Route::resource('clients', ClientController::class);
    Route::post('clients/{client}/add-interaction', [ClientController::class, 'addInteraction'])->name('clients.add-interaction');

    // Gestion des locations
    Route::resource('rentals', RentalController::class);

    // Gestion des paiements
    Route::resource('payments', PaymentController::class);
    Route::post('payments/{payment}/send-reminder', [PaymentController::class, 'sendPaymentReminder'])->name('payments.send-reminder');
    Route::post('payments/{payment}/send-invoice', [PaymentController::class, 'sendInvoice'])->name('payments.send-invoice');
    Route::post('payments/{payment}/mark-as-paid', [PaymentController::class, 'markAsPaid'])->name('payments.mark-as-paid');
});
