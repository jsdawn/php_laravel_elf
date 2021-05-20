<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessLog extends Model
{
    use SoftDeletes;

    protected $table = 'access_log';
    protected $primaryKey = 'aid';

    protected $guarded = [];

}