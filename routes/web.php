<?php

use App\Http\Controllers\Backend\RentalController as BackendRentalController;
use App\Http\Controllers\Frontend\RentalController as FrontendRentalController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\SpaController;

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

// Route::get('/{any}', SpaController::class)->where('any', '^(?!api).*$');
Route::get('/', [FrontendRentalController::class, 'index']);
Route::post('/rental', [FrontendRentalController::class, 'store']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [BackendRentalController::class, 'index']);
    Route::get('/dashboard/json/rentals', [BackendRentalController::class, 'rentals']);
    Route::patch('/dashboard/rentals/{rental}/updateStatus/{status}', [BackendRentalController::class, 'updateStatus']);
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
