@extends('layouts.app')

@section('content')
    <div style="display: inline-block">
        <form action="{{route('groups.students.create', $group)}}" method="get">
            @csrf
            <div class="col-sm-6">
                <button type="submit" class="btn btn-success">
                    Add student
                </button>
            </div>
        </form>
    </div>
    <div style="display: inline-block">
        <form action="{{route('groups.edit', $group)}}" method="get">
            @csrf
            <button class="btn btn-info">Edit current Group</button>
        </form>
    </div>
    @if(session('message'))
        <div class="alert alert-danger">
            {{session('message')}}
        </div>
    @endif
    @include('errors')
    <div>
        Students of group: {{$group->name}}
        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Avatar</th>
                <th scope="col">Full name</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Marks</th>
                <th scope="col">Average Rating</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                @php
                    $avg = $student->marks->avg('mark');
                    $class_name;
                    if ($avg == 5) {
                        $class_name = "bg-success";
                    } elseif ($avg >= 4.5) {
                        $class_name = "bg-warning";
                    } elseif ($avg <= 3) {
                        $class_name = "bg-danger";
                    } else {
                        $class_name = "table-light";
                    }

                @endphp
                <tr class="{{$class_name}}">
                    <td>
                        <img src="/avatars/{{$student->avatar}}" style="width: 100px; height: 100px; border-radius: 50%">
                    </td>
                    <td>
                        <div>{{$student->surname}}</div>
                        <div>{{$student->name}}</div>
                        <div>{{$student->patronymic}}</div>
                    </td>
                    <td>
                        <div>{{$student->birth_date}}</div>
                    </td>
                    <td>
                        <table class="table table-bordered table-sm">
                            @foreach($subjects as $subject)
                                <tr>
                                    <th scope="row">{{$subject->name}}:</th>
                                    @foreach($student->marks->where('subject_id', $subject->id) as $mark)
                                        <td>
                                            {{$mark->mark}}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </td>
                    <td>
                        {{$student->marks->avg('mark')}}
                    </td>
                    {{--@if(Auth::user()->is_admin)--}}
                    <td>
                        <form action="{{route('groups.students.show', [$group, $student])}}" method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{route('groups.students.show', [$group, $student])}}">Анкета</a>
                    </td>
                    {{--@else--}}
                    {{--<td>--}}
                        {{--Action allowed only for admin--}}
                    {{--</td>--}}
                    {{--@endif--}}
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$students->links()}}
    </div>
@endsection
