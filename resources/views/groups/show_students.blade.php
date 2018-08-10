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
                        <div><a href="{{route('students.show', $student)}}">{{$student->id}}</a></div>
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
                        @foreach($subjects as $subject)
                            {{$subject->name}}
                            @foreach($student->marks->where('subject_id', $subject->id) as $mark)
                                <div>{{$mark->mark}}</div>
                            @endforeach
                            Average Rating for {{$subject->name}}:
                            <div>{{$student->marks->where('subject_id', $subject->id)->avg('mark')}}</div>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
