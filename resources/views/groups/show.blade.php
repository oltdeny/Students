@extends('layouts.app')
@section('content')
    <div style="display: inline-block">
        <form action="{{route('groups.students.create', $group)}}" method="get">
            {{csrf_field()}}
            <div class="col-sm-6">
                <button type="submit" class="btn btn-success">
                    Add student
                </button>
            </div>
        </form>
    </div>
    <div style="display: inline-block">
        <form action="{{route('groups.destroy', $group)}}" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button class="btn btn-danger">Delete current Group</button>
        </form>
    </div>
    <div style="display: inline-block">
        <form action="{{route('groups.edit', $group)}}" method="get">
            {{csrf_field()}}
            <button class="btn btn-info">Edit current Group</button>
        </form>
    </div>
    <div>
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
                        <div><a href="{{route('groups.students.show', [$group, $student])}}">{{$student->id}}</a></div>
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
    </div>
@endsection
