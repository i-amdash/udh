<?php

use App\Livewire\Features\About;
use App\Livewire\Features\Booking\Pages\MainPage;
use App\Livewire\Features\Booking\Pages\PaymentNotificationPage;
use App\Livewire\Features\Gallery;
use App\Livewire\Features\Merchandise;
use App\Livewire\Features\Offerings;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'booking'], function () {
    Route::get('{step?}', MainPage::class)->name('booking');
});
Route::get('payment/{ref}', PaymentNotificationPage::class)->name('payment.notification');

Route::get('/merchandise', Merchandise::class)->name('merchandise');
Route::get('/about', About::class)->name('about');
Route::get('/gallery', Gallery::class)->name('gallery');
Route::get('/offerings', Offerings::class)->name('offerings');

