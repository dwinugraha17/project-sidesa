<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\SocialAidController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Resident\AuthController as ResidentAuthController;
use App\Http\Controllers\Resident\DashboardController as ResidentDashboardController;
use App\Models\Resident;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/berita/{slug}', [HomeController::class, 'showNews'])->name('news.show');

// Authentication Admin
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authentication Warga
Route::get('/warga/login', [ResidentAuthController::class, 'showLogin'])->name('warga.login')->middleware('guest');
Route::post('/warga/login', [ResidentAuthController::class, 'login'])->name('warga.login.submit');
Route::post('/warga/logout', [ResidentAuthController::class, 'logout'])->name('warga.logout');

// Protected Routes Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $totalResidents = Resident::count();
        $totalMale = Resident::where('gender', 'male')->count();
        $totalFemale = Resident::where('gender', 'female')->count();
        $totalActive = Resident::where('status', 'active')->count();
        
        return view('pages.dashboard', compact('totalResidents', 'totalMale', 'totalFemale', 'totalActive'));
    })->name('dashboard');

    // Routes khusus Super Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('resident', ResidentController::class);
        Route::get('/letters/requests', [LetterController::class, 'requests'])->name('letters.requests.index');
        Route::put('/letters/requests/{id}', [LetterController::class, 'updateStatus'])->name('letters.requests.update');
        Route::get('/letters/{id}/download', [LetterController::class, 'download'])->name('letters.download');
        Route::resource('letters', LetterController::class);
        Route::get('/social-aid', [SocialAidController::class, 'index'])->name('social-aid.index');
        Route::post('/social-aid', [SocialAidController::class, 'store'])->name('social-aid.store');
        Route::get('/social-aid/{id}', [SocialAidController::class, 'show'])->name('social-aid.show');
        Route::post('/social-aid/{id}/recipient', [SocialAidController::class, 'addRecipient'])->name('social-aid.recipient.store');
        Route::delete('/social-aid/recipient/{id}', [SocialAidController::class, 'destroyRecipient'])->name('social-aid.recipient.destroy');

        // Budget Routes
        Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index');
        Route::post('/budget', [BudgetController::class, 'store'])->name('budget.store');
        Route::post('/budget/transaction', [BudgetController::class, 'storeTransaction'])->name('budget.transaction.store');

        // Statistic Routes
        Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');
    });

    // Routes Frontend Management (Bisa diakses Super Admin & Web Admin)
    Route::middleware(['role:admin,web_admin'])->prefix('management')->name('management.')->group(function () {
        Route::resource('news', \App\Http\Controllers\NewsController::class);
        Route::resource('banners', \App\Http\Controllers\BannerController::class);
        Route::resource('staff', \App\Http\Controllers\StaffController::class);
        Route::resource('products', \App\Http\Controllers\ProductController::class);
        Route::resource('galleries', \App\Http\Controllers\GalleryController::class);
        Route::get('/messages', [\App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{id}', [\App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{id}', [\App\Http\Controllers\MessageController::class, 'destroy'])->name('messages.destroy');

        // Complaint Management
        Route::resource('complaints', \App\Http\Controllers\ComplaintController::class)->except(['create', 'store', 'edit']);
        
        // Poll Management
        Route::resource('polls', \App\Http\Controllers\PollController::class);
        Route::patch('polls/{poll}/toggle', [\App\Http\Controllers\PollController::class, 'toggleStatus'])->name('polls.toggle');
    });
});

Route::get('/debug-photo', function() {
    $complaint = \App\Models\Complaint::first();
    if (!$complaint) return "No complaint found";
    return [
        'db_path' => $complaint->photo,
        'storage_url' => Storage::url($complaint->photo),
        'asset_url' => asset('storage/' . $complaint->photo),
        'exists' => Storage::disk('public')->exists($complaint->photo)
    ];
});

// Public Message Store
Route::post('/messages', [\App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');

// Protected Routes Warga
Route::middleware(['auth:resident'])->prefix('warga')->group(function () {
    Route::get('/dashboard', [ResidentDashboardController::class, 'index'])->name('warga.dashboard');
    Route::post('/request', [ResidentDashboardController::class, 'requestLetter'])->name('warga.request.submit');

    // Complaint Routes for Warga
    Route::resource('complaints', \App\Http\Controllers\Resident\ComplaintController::class)->names([
        'index' => 'resident.complaints.index',
        'create' => 'resident.complaints.create',
        'store' => 'resident.complaints.store',
        'show' => 'resident.complaints.show',
    ]);

    // Poll Routes for Warga
    Route::get('/polls', [\App\Http\Controllers\Resident\PollController::class, 'index'])->name('resident.polls.index');
    Route::post('/polls/{poll}/vote', [\App\Http\Controllers\Resident\PollController::class, 'vote'])->name('resident.polls.vote');
});


