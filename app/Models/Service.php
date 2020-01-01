<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function offers()
    {
        return $this->hasMany(Offer::class,'service_id', 'id');
    }
}
