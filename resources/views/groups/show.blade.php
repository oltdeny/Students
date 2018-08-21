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
    @include('errors')
    <form class="form-group" action="{{route('groups.students.search', $group)}}" method="get">
        @csrf
        <label for="name">Search student by:</label>
        <div class="row">
            <div class="col">
                <input type="text" name="name" id="name" class="form-control" placeholder="name">
            </div>
            <div class="col">
                <input type="text" name="surname"class="form-control" placeholder="surname">
            </div>
            <div class="col">
                <input type="text" name="patronymic" class="form-control" placeholder="patronymic">
            </div>
            @if(isset($prev))
                <div class="col">
                    <input type="hidden" name="prev" value="{{$prev}}">
                </div>
            @endif
            <div class="col">
                <button class="btn btn-info">Search</button>
            </div>
        </div>
    </form>
    <div>
        Students of group: {{$group->name}}
        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
            <tr>
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
                    <td>
                        <form action="{{route('groups.students.show', [$group, $student])}}" method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger" disabled>Delete</button>
                        </form>
                        <a href="{{route('groups.students.show', [$group, $student])}}">Анкета</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$students->links()}}
    </div>
@endsection
