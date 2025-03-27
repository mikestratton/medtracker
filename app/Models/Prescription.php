<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    /** @use HasFactory<\Database\Factories\PrescriptionFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'prescriber_id',
        'name',
        'dosage',
        'per_day',
        'prescriber',
        'time_of_day'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
