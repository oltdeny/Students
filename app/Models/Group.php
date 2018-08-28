<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Builder;

class Group extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function scopeAvg($query, $subjects)
    {
        $query->select('groups.*');
        foreach ($subjects as $subject) {
            $subQuery = Mark::selectRaw("AVG(marks.mark) as mark")
                ->whereRaw("marks.group_id = groups.id")
                ->where("marks.subject_id", $subject->id);
            $query->selectSub($subQuery, $subject->id);
        }
        $subQueryAvg = Mark::selectRaw("AVG(marks.mark) as mark")
            ->whereRaw("marks.group_id = groups.id");
        $query->selectSub($subQueryAvg, "avg");

        return $query;
    }
}
