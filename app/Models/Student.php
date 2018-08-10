<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function findAverageRating()
    {
        $subjects = Subject::all();
        $marks = $this->marks;
        $AverageRating = $marks->where('subject_id', 1)->avg('mark');
    }
}
