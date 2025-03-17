<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities";
    protected $fillable = [
        'name',
        'population',
        'country_id'
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
