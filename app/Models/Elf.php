<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Elf extends Model
{
    use SoftDeletes;

    protected $table = 'elf';
    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    // 获取精灵的情景
    public function scenes()
    {
        return $this->hasMany(Scene::class, 'elf_id', 'id');
    }

    // 精灵的角色
    public function roles()
    {
        return $this
            ->belongsToMany(Role::class, 'role_elf', 'elf_id', 'role_id')
            ->withTimestamps();
    }
}
