<?php

namespace App\Listeners;

use App\Http\Controllers\MedicationAdministrationController;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateMedicationTimesListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $controller = new MedicationAdministrationController();
        $controller->createMedicationTimes();
    }
}
