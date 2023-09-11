<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ExternalController;
use App\Http\Controllers\API\PermissionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::group(['middleware' => ['api', 'auth:api'], 'name' => 'api.'], function () {

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('users', [UserController::class, 'index'])->name('users.index'); // user Slash all
    Route::post('profile', [UserController::class, 'profile'])->name('user_profile');
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/{slug}', [PostController::class, 'show'])->name('posts.show');
    Route::Put('posts/{slug}', [PostController::class, 'update'])->name('posts.update');
    Route::Delete('posts/{slug}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('post/{post}', [PostController::class, 'showById'])->name('posts.showbyId');
});
Route::get('country-and-lang', [ExternalController::class, 'MergedApi'])->name('CountryAndLang');// change the name of routes follow naming conventions
