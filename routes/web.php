<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZohoController;
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

// Add contact in ZOHO
Route::get('/zoho-add-dial', [ZohoController::class, 'zohoAddDial'])->name('zohoAddDial');
Route::get('/zoho-list-dials', [ZohoController::class, 'zohoListDials'])->name('zohoListDials');
