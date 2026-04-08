<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
