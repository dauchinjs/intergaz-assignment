<?php

use App\Http\Controllers\ClientsListController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Route
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->middleware(['auth'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->middleware(['auth'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware(['auth'])->name('profile.destroy');
});

Route::get('/clients', [ClientsListController::class, 'index'])->middleware(['auth'])->name('clients');
Route::get('/clients/inactive', [ReportsController::class, 'inactiveClients'])->middleware(['auth'])->name('clients.inactive');
Route::get('/clients/{client}', [ClientsListController::class, 'show'])->middleware(['auth'])->name('clients.show');

Route::get('/deliveries', [ReportsController::class, 'deliveryTypes'])->middleware(['auth'])->name('deliveries');
Route::get('/deliveries/history', [ReportsController::class, 'deliveryHistory'])->middleware(['auth'])->name('deliveries.show');

require __DIR__.'/auth.php';
