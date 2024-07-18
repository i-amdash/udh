<?php

use App\Livewire\Features\Booking\Pages\MainPage;
use App\Livewire\Features\Booking\Pages\PaymentNotificationPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'booking'], function () {
    Route::get('{step?}', MainPage::class)->name('booking');
});
Route::get('payment/{ref}', PaymentNotificationPage::class)->name('payment.notification');
