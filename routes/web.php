<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminOptionController;
use App\Http\Controllers\Admin\AdminPropertyController;
use App\Http\Controllers\Admin\PictureController;
use App\Http\Controllers\ImageController;

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


Route::get("/login", [AuthController::class, "login"])->name('login');
Route::post("/login", [AuthController::class, "signIn"]);
Route::get("/register", [AuthController::class, "register"])->name('register');
Route::post("/register", [AuthController::class, "signUp"]);
Route::delete('/logout', [AuthController::class, "logout"])->middleware("auth")->name("logout");


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

    Route::get("/", function () {
        return view("admin.index");
    })->name("index");

    // --- BIENS ---
    Route::put("/properties/{propertyId}/restore", [AdminPropertyController::class, 'restore'])->name('properties.restore')->where([
        'propertyId' => $idRegex,
    ]);
    Route::resource("properties", AdminPropertyController::class)->except(['show']);


    // --- OPTIONS ---
    Route::resource("options", AdminOptionController::class)->except(['show']);

    // --- USERS ---
    Route::resource("users", AdminUserController::class)->except(['show']);

    Route::delete('picture/{picture}', [PictureController::class, 'destroy'])->name('picture.destroy')->where([
        "picture" => $idRegex,
    ]);
});
