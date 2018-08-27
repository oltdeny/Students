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

    public function scopeFilter($query, $request)
    {
        if (isset($request->surname)) {
            $query->where('surname', $request->surname);
        }
        if (isset($request->name)) {
            $query->where('name', $request->name);
        }
        if (isset($request->patronymic)) {
            $query->where('patronymic', $request->patronymic);
        }
        if (isset($request->group_id)) {
            $query->where('group_id', $request->group_id);
        }
        $subjects = Subject::all();
        $query->select('students.*');
        foreach ($subjects as $subject) {
            if (isset($request->{'avg' . $subject->id})) {
                $parameters = explode('-', $request->{'avg' . $subject->id});
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
