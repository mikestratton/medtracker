<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TimezoneService
{
    public function getUserDateInTimezone(Carbon $carbonDate, $dateModifier = null)
    {
        $user = Auth::user();

        if ($user && $user->timezone) {
            $userTimezone = $user->timezone;
            $utcNow = Carbon::now('UTC');
            $userNow = $utcNow->setTimezone($userTimezone);

            if ($dateModifier) {
                $userNow->{$dateModifier}();
            }

            return $userNow->toDateString();
        } else {
            if ($dateModifier) {
                $carbonDate->{$dateModifier}();
            }
            return $carbonDate->toDateString();
        }
    }

    public function getTodayInUserTimezone()
    {
        return $this->getUserDateInTimezone(Carbon::today());
    }

    public function getTomorrowInUserTimezone()
    {
        return $this->getUserDateInTimezone(Carbon::today(), 'addDay');
    }
}
