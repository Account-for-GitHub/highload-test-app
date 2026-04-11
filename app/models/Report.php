<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $fillable = [
        'request_id',
        'format',
        'report',
    ];

    public function request(): BelongsTo {
        return $this->belongsTo(Request::class);
    }
}
