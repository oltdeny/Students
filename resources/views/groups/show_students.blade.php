@extends('layouts.app')
@section('content')
    <form action="{{route('students.create', $group)}}" method="get">
        {{csrf_field()}}
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success">
                Add student
            </button>
        </div>
        <input type="hidden" name="group" value="{{$group->id}}">
    </form>
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
                        <form action="{{route('groups.destroy', $group)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        <form action="{{route('groups.edit', $group)}}" method="get">
                            {{csrf_field()}}
                            <button class="btn btn-info">Edit</button>
                        </form>
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
