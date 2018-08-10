@extends('layouts.app')
@section('content')
    <table class="table table-bordered">
        <thead>
        Student of group: {{$student->group->name}}
        <th>Id</th>
        <th>Surname</th>
        <th>Name</th>
        <th>Patronymic</th>
        </thead>
        <tbody>
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
        </tr>
        </tbody>
    </table>
    <table class="table table-bordered">
        <thead>Marks:</thead>
        <tbody>
        <tr>
            @foreach($subjects as $subject)
                <td>
                    {{$subject->name}}:
                    @foreach($student->marks->where('subject_id', $subject->id) as $mark)
                        <div>{{$mark->mark}}</div>
                    @endforeach
                    Average Rating for {{$subject->name}}:
                    <div>{{$student->marks->where('subject_id', $subject->id)->avg('mark')}}</div>
                </td>
            @endforeach
            Average rating: {{$student->marks->avg('mark')}}
        </tr>
        </tbody>
    </table>
    <div>
        <form action="{{route('students.destroy', $student)}}" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button class="btn btn-danger">Delete</button>
        </form>
        <form action="{{route('students.edit', $student)}}" method="get">
            {{csrf_field()}}
            <button class="btn btn-info">Edit</button>
        </form>
    </div>
@endsection
