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
    return view('zoho-list-deals');
});

// Add contact in ZOHO
Route::post('/zoho-add-deal', [ZohoController::class, 'zohoAddDeal'])->name('zohoAddDeal');
Route::get('/zoho-add-deal-view', [ZohoController::class, 'zohoAddDealView'])->name('zohoAddDealView');
Route::get('/zoho-list-deals', [ZohoController::class, 'zohoListDeals'])->name('zohoListDeals');
