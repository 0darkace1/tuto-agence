<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminOptionController;
use App\Http\Controllers\Admin\AdminPropertyController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PictureController;

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

Route::get('/', [HomeController::class, "home"])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/images/{path}', [ImageController::class, "show"])->where('path', '.*');

Route::prefix("/properties")->name("properties.")->controller(PropertyController::class)->group(function () {
    $idRegex = "[0-9]+";
    $slugRegex = "[0-9a-z\-]+";

    Route::get('/', "index")->name('index');

    Route::get('/{slug}-{property}', "show")->name('show')->where([
        'slug' => $slugRegex,
        'property' => $idRegex,
    ]);

    Route::post('/{property}/contact', "contact")->name('contact')->where([
        'property' => $idRegex,
    ]);
});

Route::prefix("/admin")->name('admin.')->middleware(["auth", "admin"])->group(function () {
    $idRegex = "[0-9]+";
    $uuidRegex = "[0-9a-z\-]+";

    Route::get("/", function () {
        return view("admin.index");
    })->name("index");

    // --- NOTIFICATIONS ---
    Route::get('/notifications', [NotificationController::class, 'index'])->name("notifications.index");
    Route::get("/notifications/{notificationId}", [NotificationController::class, "show"])->name("notifications.show")->where([
        'notificationId' => $uuidRegex,
    ]);
    Route::delete("/notifications/{notificationId}", [NotificationController::class, "destroy"])->name("notifications.destroy")->where([
        'notificationId' => $uuidRegex,
    ]);

    // --- BIENS ---
    Route::put("/properties/{property}/restore", [AdminPropertyController::class, 'restore'])->name('properties.restore')->where([
        'property' => $idRegex,
    ])->withTrashed();
    Route::resource("properties", AdminPropertyController::class)->except(['show']);

    // --- OPTIONS ---
    Route::resource("options", AdminOptionController::class)->except(['show']);

    // --- USERS ---
    Route::resource("users", AdminUserController::class)->except(['show']);

    Route::delete('picture/{picture}', [PictureController::class, 'destroy'])->name('picture.destroy')->where([
        "picture" => $idRegex,
    ])->can('delete,picture');
});

require __DIR__ . '/auth.php';
