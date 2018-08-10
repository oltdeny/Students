<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    protected $fillable = [
        'name',
        'description'
    ];
}
