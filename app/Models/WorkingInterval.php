<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingInterval extends Model
{
    protected $fillable = [
        'starts_at',
        'ends_at',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }
}
