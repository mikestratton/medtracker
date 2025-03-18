<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MedicationAdministrationController;
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

Route::patch('/events/{event}', [EventController::class, 'update'])->name('events.update')->middleware(['auth']);

Route::resource('medication_administration', MedicationAdministrationController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth']);

Route::get('/test-function', function () {
    // Assuming your function is in a class called YourController
    $controller = new MedicationAdministrationController(); // Or use dependency injection

    // If your function is a static method, you can call it directly:
    // $result = YourController::yourFunction();

    // Assuming your function is a method in the controller instance
    $result = $controller->getTomorrowInUserTimezone(); // Replace with your function call

    // Output the result (e.g., return a response, dump to the screen)
    return $result; // Or dd($result); or view('test-view', ['result' => $result]);
});

require __DIR__.'/auth.php';
