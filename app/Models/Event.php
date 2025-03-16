<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'medication_administration_id',
        'times_taken_daily',
        'has_taken_medication',
        'note',
        'date',
        'time'
      ];

      public function user(): BelongsTo
      {
          return $this->belongsTo(User::class);
      }

      public function medication_administration(): BelongsTo
      {
          return $this->belongsTo(MedicationAdministration::class);
      }
}
