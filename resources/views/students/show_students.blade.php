@extends('layouts.app')
@section('content')
    <table class="table table-bordered">
        <thead>
        Students of group: {{$group->name}}
        <th>Id</th>
        <th>Surname</th>
        <th>Name</th>
        <th>Patronymic</th>
        <th>Marks</th>
        </thead>
        <tbody>
            @foreach($group->students as $student)
                <tr>
                    <td class="table-text">
                        <div>{{$student->id}}</div>
                    </td>
                    <td class="table-text">
                        <div>{{$student->surname}}</div>
                    </td>
                    <td class="table-text">
                        <div>{{$student->name}}</div>
                    </td>
                    <td class="table-text">
                        <div>{{$student->patronymic}}</div>
                    </td>
                    <td>
                        @foreach($student->marks as $mark)
                            <div>{{$mark->subject->name}}</div>
                            <div>{{$mark->mark}}</div>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
