<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends Model
{
    protected $fillable = [
        'request_id',
        'status',
        'response',
    ];
    
    public function request(): BelongsTo {
        return $this->belongsTo(Request::class);
    }
}
