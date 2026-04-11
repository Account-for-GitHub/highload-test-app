<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Request extends Model
{
    protected $fillable = [
        'url',
        'quantity',
        'request_json',
    ];
    
    public function responses(): HasMany {
        return $this->hasMany(Response::class);
    }

    public function reports(): HasOne {
        return $this->hasOne(Report::class);
    }
}
