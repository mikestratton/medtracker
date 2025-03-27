<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescriber extends Model
{
    /** @use HasFactory<\Database\Factories\PrescriberFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'organization'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
