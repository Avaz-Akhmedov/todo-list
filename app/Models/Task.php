<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];


    public function statusHistories(): HasMany
    {
        return $this->hasMany(StatusHistory::class);
    }

    public function scopeStatusFilter(Builder $query, Request $request)
    {
        $status = $request->input('status');

        return $query->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        });
    }
}
