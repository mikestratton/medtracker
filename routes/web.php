<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MedicationAdministrationController;
use App\Http\Controllers\PrescriberController;
use App\Http\Controllers\PrescriptionController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::resource('events', EventController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth'])  ;

//Route::patch('/events/{event}', [EventController::class, 'update'])->name('events.update')->middleware(['auth']);

Route::resource('medication_administration', MedicationAdministrationController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth']);

Route::get('/history', [HistoryController::class, 'index'])->name('history.index')->middleware(['auth']);
Route::put('/history/{id}', [HistoryController::class, 'update'])->name('history.update')->middleware(['auth']);
//Route::put('/history/{id}', [HistoryController::class, 'update'])->middleware(['auth']);


Route::resource('prescriptions', PrescriptionController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth']);

Route::resource('prescribers', PrescriberController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth']);

require __DIR__.'/auth.php';
