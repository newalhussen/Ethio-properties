
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ModerationController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\Owner\MessageController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Owner\OwnerSettingsController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\GoogleController;

//Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        
        // Moderation Routes
        Route::get('/moderation', [ModerationController::class, 'dashboard'])->name('moderation');
        // Route::post('/houses/{house}/approve', [ModerationController::class, 'approveHouse'])->name('houses.approve');
        // Route::post('/houses/{house}/reject', [ModerationController::class, 'rejectHouse'])->name('houses.reject');
        // Route::post('/cars/{car}/approve', [ModerationController::class, 'approveCar'])->name('cars.approve');
        // Route::post('/cars/{car}/reject', [ModerationController::class, 'rejectCar'])->name('cars.reject');
    });
});


//Authentication Routes
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin Login Routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

/*
| Public Pages
*/

Route::get('/', [UserHomeController::class, 'index'])->name('user.home');
Route::get('/home', fn() => view('user.home'))->name('home');

/*
| Property Routes
*/
Route::get('/properties/create', [PropertyController::class, 'create'])->name('owner.properties.create');
Route::post('/properties/store', [PropertyController::class, 'store'])->name('properties.store');

/*
| Car Routes (Public)
*/
Route::get('/cars', [CarController::class, 'index'])->name('user.cars.index');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('user.cars.show');

// House routes (public)
Route::get('/houses', [HouseController::class, 'index'])->name('houses.index');
Route::get('/houses/{id}', [HouseController::class, 'show'])->name('houses.show');
Route::post('houses/{house}/contact', [HouseController::class, 'contact'])->name('houses.contact');

// House creation routes (authenticated)
Route::middleware(['auth'])->group(function () {
    Route::get('/houses/create', [HouseController::class, 'create'])->name('owner.houses.create');
    Route::post('/houses', [HouseController::class, 'store'])->name('houses.store');
});

/*
| Car Routes (Authenticated Users)
*/
Route::middleware(['auth'])->group(function () {
    // Create & store
    Route::post('/cars/store', [CarController::class, 'store'])->name('cars.store');
    // Soft delete
    Route::delete('/cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');
    // Restore soft-deleted car
    Route::post('/cars/{id}/restore', [CarController::class, 'restore'])->name('cars.restore');
    // Permanently delete soft-deleted car
    Route::delete('/cars/{id}/force-delete', [CarController::class, 'forceDelete'])->name('cars.forceDelete');
});

/*
| Choose Post Type
*/
Route::get('/choose-post', function () {
    return view('owner.properties.choose_post_type');
})->middleware('auth')->name('choose.post');

/*
| Owner Dashboard Routes
*/
Route::prefix('owner')->middleware(['auth', 'owner'])->group(function () {
    Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');
    Route::get('/create', [OwnerDashboardController::class, 'create'])->name('owner.cars.create');
    Route::post('/store', [OwnerDashboardController::class, 'store'])->name('owner.store');
    Route::get('/edit/{car}', [OwnerDashboardController::class, 'edit'])->name('owner.cars.edit');
    Route::put('/update/{car}', [CarController::class, 'update'])->name('owner.update');


    // Soft delete under owner section
    Route::delete('/delete/{car}', [OwnerDashboardController::class, 'destroy'])->name('owner.delete');

    // Mark car as sold
    Route::post('/mark-sold/{car}', [OwnerDashboardController::class, 'markSold'])->name('owner.markSold');

    // Track phone number views
    Route::post('/phone-view/{car}', [OwnerDashboardController::class, 'phoneView'])->name('owner.phoneView');

    Route::get('/total-posts', [OwnerDashboardController::class, 'totalPosts'])
    ->name('owner.totalPosts');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        // New route for property owners
    Route::get('/users/owners', [App\Http\Controllers\UserController::class, 'owners'])->name('users.owners');

    // Optional: Buyers/Renters route if needed
    Route::get('/users/buyers', [App\Http\Controllers\UserController::class, 'buyers'])->name('users.buyers');

    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});

// Admin Car Management
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/cars', [App\Http\Controllers\Admin\CarController::class, 'index'])->name('cars.index');
    Route::get('/cars/pending', [App\Http\Controllers\Admin\CarController::class, 'pending'])->name('cars.pending');
    Route::get('/cars/approved', [App\Http\Controllers\Admin\CarController::class, 'approved'])->name('cars.approved');
    Route::get('/cars/rejected', [App\Http\Controllers\Admin\CarController::class, 'rejected'])->name('cars.rejected');
    Route::get('/cars/{id}', [App\Http\Controllers\Admin\CarController::class, 'show'])->name('cars.show');
    Route::delete('/cars/{id}', [App\Http\Controllers\Admin\CarController::class, 'destroy'])->name('cars.destroy');
     Route::post(
        '/cars/{car}/toggle-featured',
        [App\Http\Controllers\Admin\CarController::class, 'toggleFeatured']
    )->name('cars.toggleFeatured');
      Route::post(
        '/houses/{house}/toggle-featured',
        [App\Http\Controllers\Admin\HouseController::class, 'toggleFeatured']
    )->name('houses.toggleFeatured');
    Route::post('/cars/{id}/approve', [App\Http\Controllers\Admin\CarController::class, 'approve'])
    ->name('cars.approve');

Route::post('/cars/{id}/reject', [App\Http\Controllers\Admin\CarController::class, 'reject'])
    ->name('cars.reject');

});

// Admin House Management
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // existing car routes...
    // House routes
    Route::get('/houses', [App\Http\Controllers\Admin\HouseController::class, 'index'])->name('houses.index');
    Route::get('/houses/pending', [App\Http\Controllers\Admin\HouseController::class, 'pending'])->name('houses.pending');
    Route::get('/houses/approved', [App\Http\Controllers\Admin\HouseController::class, 'approved'])->name('houses.approved');
    Route::get('/houses/rejected', [App\Http\Controllers\Admin\HouseController::class, 'rejected'])->name('houses.rejected');
    Route::get('/houses/{id}', [App\Http\Controllers\Admin\HouseController::class, 'show'])->name('houses.show');
    Route::delete('/houses/{id}', [App\Http\Controllers\Admin\HouseController::class, 'destroy'])->name('houses.destroy');

    // Approve / Reject (AJAX)
    Route::post('/houses/{id}/approve', [App\Http\Controllers\Admin\HouseController::class, 'approve'])->name('houses.approve');
    Route::post('/houses/{id}/reject', [App\Http\Controllers\Admin\HouseController::class, 'reject'])->name('houses.reject');
});
Route::prefix('owner')->middleware(['auth', 'owner'])->group(function () {
    Route::get('/houses/create', [HouseController::class, 'create'])->name('owner.house.create');
    Route::get('/houses/edit/{house}', [HouseController::class, 'edit'])->name('owner.houses.edit');
    Route::put('/houses/update/{house}', [HouseController::class, 'update'])->name('owner.houses.update');
     Route::delete('/house/delete/{house}', [HouseController::class, 'destroy'])->name('owner.houses.delete');

     Route::get('/customers', [\App\Http\Controllers\Owner\CustomersController::class, 'index'])->name('owner.customers.index');

});
Route::get('/owner/cars', [OwnerDashboardController::class, 'carsIndex'])->name('owner.cars.index');
Route::get('/owner/houses', [HouseController::class, 'ownerIndex'])->name('owner.houses.index');
Route::prefix('owner')->name('owner.')->group(function() {
    Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('owner.profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('owner.profile.update');
});
Route::middleware(['auth', 'role:owner'])->group(function () {

    Route::get('/owner/recycle-bin', [\App\Http\Controllers\OwnerRecycleBinController::class, 'index'])
        ->name('owner.recycleBin');

    // Houses
    Route::post('/owner/recycle-bin/house/{id}/restore', [\App\Http\Controllers\OwnerRecycleBinController::class, 'restoreHouse'])
        ->name('owner.recycleBin.house.restore');
    Route::delete('/owner/recycle-bin/house/{id}/destroy', [\App\Http\Controllers\OwnerRecycleBinController::class, 'forceDeleteHouse'])
        ->name('owner.recycleBin.house.destroy');

    // Cars
    Route::post('/owner/recycle-bin/car/{id}/restore', [\App\Http\Controllers\OwnerRecycleBinController::class, 'restoreCar'])
        ->name('owner.recycleBin.car.restore');
    Route::delete('/owner/recycle-bin/car/{id}/destroy', [\App\Http\Controllers\OwnerRecycleBinController::class, 'forceDeleteCar'])
        ->name('owner.recycleBin.car.destroy');
});

Route::middleware(['auth'])->prefix('owner')->name('owner.')->group(function () {
    // Show settings page
    Route::get('/settings', [OwnerSettingsController::class, 'edit'])->name('settings.edit');

    // Update settings (single handler using 'section' input)
    Route::post('/settings', [OwnerSettingsController::class, 'update'])->name('settings.update');
});

Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {
    Route::get('profile', [App\Http\Controllers\Admin\AdminProfileController::class, 'edit'])->name('profile');
    Route::post('profile/update', [App\Http\Controllers\Admin\AdminProfileController::class, 'update'])->name('profile.update');
    
        // Messages listing
    Route::get('/messages', [\App\Http\Controllers\Admin\AdminMessageController::class, 'index'])->name('messages.index');

    // Show single message
    Route::get('/messages/{message}', [\App\Http\Controllers\Admin\AdminMessageController::class, 'show'])->name('messages.show');

    // Delete message
    Route::delete('/messages/{message}', [\App\Http\Controllers\Admin\AdminMessageController::class, 'destroy'])->name('messages.destroy');

    // Mark message viewed (POST)
    Route::post('/messages/{message}/view', [\App\Http\Controllers\Admin\AdminMessageController::class, 'markViewed'])->name('messages.markViewed');
});
Route::get('/admin/cars/{id}/edit', [\App\Http\Controllers\Admin\CarController::class, 'edit'])->name('admin.cars.edit');
Route::post('/admin/cars/{id}/update', [\App\Http\Controllers\Admin\CarController::class, 'update'])->name('admin.cars.update');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/suggest', [SearchController::class, 'suggest'])->name('search.suggest');