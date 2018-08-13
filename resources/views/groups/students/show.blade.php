@extends('layouts.app')
@section('content')
    <div style="display: inline-block">
        <form action="{{route('groups.students.marks.create', [$group, $student])}}" method="get">
            {{csrf_field()}}
            <button class="btn btn-success">Add Mark</button>
        </form>
    </div>
    <div style="display: inline-block">
        <form action="{{route('groups.students.destroy', [$group, $student])}}" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button class="btn btn-danger">Delete current Student</button>
        </form>
    </div>
    <div style="display: inline-block">
        <form action="{{route('groups.students.edit', [$group, $student])}}" method="get">
            {{csrf_field()}}
            <button class="btn btn-info">Edit current Student</button>
        </form>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
            Student of group: {{$group->name}}
            <th>Id</th>
            <th>Surname</th>
            <th>Name</th>
            <th>Patronymic</th>
            </thead>
            <tbody>
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
            </tr>
            </tbody>
        </table>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>Marks:</thead>
            <tbody>
            <tr>
                @foreach($subjects as $subject)
                    <td>
                        {{$subject->name}}:
                        @foreach($student->marks->where('subject_id', $subject->id) as $mark)
                            <div>
                                <a href="{{route('groups.students.marks.edit', [$group, $student, $mark])}}">{{$mark->mark}}</a>
                            </div>
                        @endforeach
                        Average Rating for {{$subject->name}}:
                        <div>{{$student->marks->where('subject_id', $subject->id)->avg('mark')}}</div>
                    </td>
                @endforeach
            </tr>
            </tbody>
        </table>
        <div>
            Average rating: {{$student->marks->avg('mark')}}
        </div>
    </div>
@endsection
