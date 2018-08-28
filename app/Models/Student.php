<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'group_id',
        'birth_date',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function scopeFilter($query, $filter)
    {
        if (isset($filter->surname)) {
            $query->where('surname', $filter->surname);
        }
        if (isset($filter->name)) {
            $query->where('name', $filter->name);
        }
        if (isset($filter->patronymic)) {
            $query->where('patronymic', $filter->patronymic);
        }
        if (isset($filter->group_id)) {
            $query->where('group_id', $filter->group_id);
        }
        $subjects = Subject::all();
        $query->select('students.*');
        foreach ($subjects as $subject) {
            if (isset($filter->{'avg' . $subject->id})) {
                $parameters = explode('-', $filter->{'avg' . $subject->id});
                $subQuery = Mark::selectRaw("AVG(marks.mark)")
                    ->whereRaw("marks.student_id = students.id")
                    ->where("marks.subject_id", $subject->id);
                $query->selectSub($subQuery, "avg{$subject->id}")
                    ->havingRaw("avg{$subject->id} BETWEEN {$parameters[0]} AND {$parameters[1]}");
            }
        }
        return $query;
    }
}
