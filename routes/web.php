<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BasicInfoController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/uploadProfile', [ProfileController::class, 'store']);
    Route::post('/portfolio', [PortfolioController::class, 'store']);
    Route::post('/editPortfolio', [PortfolioController::class, 'update']);
    Route::post('/deletePortfolio', [PortfolioController::class, 'destroy']);
    Route::post('/selectCv', [AboutController::class, 'update']);
    Route::post('/deleteCv', [AboutController::class, 'destroy']);
    Route::post('/postSocial', [SocialController::class, 'store']);
    Route::post('/about', [AboutController::class, 'store']);

   
});

Route::get('/getProfile', [ProfileController::class, 'show']);

Route::get('/getPortfolios', [PortfolioController::class, 'index']);
Route::get('/cv_path', [AboutController::class, 'show']);
Route::get('/cvlist', [AboutController::class, 'index']);
Route::get('/getSocial', [SocialController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    

Route::view('/admin', 'welcome');

// Route::get('/basicinfo',[BasicInfoController::class,'index']);
// Route::post('/uploadImage',[UploadController::class,'store']);
//  Route::get('/userImage',[ImageController::class,'index']);


require __DIR__ . '/auth.php';


Route::any('/{slug}', function () {
    return view('notfound');
});