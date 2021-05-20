<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Websites extends Model
{
    use SoftDeletes;

    protected $table = 'Websites';
    protected $primaryKey = 'id';

    protected $attributes = [
        'alexa' => 0
    ];

    protected $guarded = [];

    public function scopeOfCountry($query, $country)
    {
        return $query->where('country', $country);
    }

    public function alog()
    {
        return $this->hasOne('App\Models\AccessLog', 'site_id', 'id');
    }
}