<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dateFormat = 'U';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//    public function getCreatedAtAttribute($value) {
//        return \Carbon\Carbon::parse($value)->format('Y-m-d H:i');
//    }
//
//    public function getUpdatedAtAttribute($value) {
//        return \Carbon\Carbon::parse($value)->format('Y-m-d H:i');
//    }
}
