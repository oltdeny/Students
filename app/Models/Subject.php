<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
