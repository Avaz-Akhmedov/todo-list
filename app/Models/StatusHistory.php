<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'task_id'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
