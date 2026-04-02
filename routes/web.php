<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Routes d'authentification
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

// Routes admin (protégées)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des biens
    Route::resource('properties', PropertyController::class);
    Route::get('properties/{property}/toggle-featured', [PropertyController::class, 'toggleFeatured'])->name('properties.toggle-featured');

    // Gestion des demandes
    Route::resource('inquiries', InquiryController::class);
     Route::resource('inquiries', InquiryController::class);
    Route::post('inquiries/bulk-delete', [InquiryController::class, 'bulkDelete'])->name('inquiries.bulk-delete');
    Route::post('inquiries/bulk-contacted', [InquiryController::class, 'bulkContacted'])->name('inquiries.bulk-contacted');
    Route::get('inquiries/export-excel', [InquiryController::class, 'exportExcel'])->name('inquiries.export-excel');
    Route::get('inquiries/export-pdf', [InquiryController::class, 'exportPdf'])->name('inquiries.export-pdf');

    // Gestion des catégories
    Route::resource('categories', CategoryController::class);

    // Gestion des slides
    Route::resource('slides', SlideController::class);

    // Gestion des utilisateurs
    Route::resource('users', UserController::class);

    // Paramètres
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    // Gestion des clients
    Route::resource('clients', ClientController::class);
    Route::post('clients/{client}/add-interaction', [ClientController::class, 'addInteraction'])->name('clients.add-interaction');

    Route::resource('rentals', RentalController::class);

    // Gestion des paiements
    Route::resource('payments', PaymentController::class);
    Route::post('payments/{payment}/send-reminder', [PaymentController::class, 'sendPaymentReminder'])->name('payments.send-reminder');
    Route::post('payments/{payment}/send-invoice', [PaymentController::class, 'sendInvoice'])->name('payments.send-invoice');
    Route::post('payments/{payment}/mark-as-paid', [PaymentController::class, 'markAsPaid'])->name('payments.mark-as-paid');
});
