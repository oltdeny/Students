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

    protected $appends = array('avg_mark');

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
        } if (isset($request->name)) {
            $query->where('name', $request->name);
        } if (isset($request->patronymic)) {
            $query->where('patronymic', $request->patronymic);
        }
        return $query;
    }
}
