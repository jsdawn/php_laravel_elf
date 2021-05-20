<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scene extends Model
{
    use SoftDeletes;

    protected $table = 'scene';
    protected $primaryKey = 'id';

    protected $guarded = [];

    // 默认加载关联
    // protected $with = ['elf'];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];


    public function elf()
    {
        return $this
            ->belongsTo(Elf::class, 'elf_id', 'id')
            ->withDefault(['name' => '游客']);
    }

    public function getFormatTitleAttribute()
    {
        return $this->title . 'format';
    }

}