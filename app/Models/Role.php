<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'role';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function elfs()
    {
        return $this
            ->belongsToMany(Elf::class, 'role_elf', 'role_id', 'elf_id')
            ->withTimestamps();
    }
}