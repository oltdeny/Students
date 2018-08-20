@extends('layouts.app')

@section('content')
        Students of group: {{$group->name}}
        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Surname</th>
                <th scope="col">Name</th>
                <th scope="col">Patronymic</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Marks</th>
                <th scope="col">Average Rating</th>
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
                        <div><a href="{{route('groups.students.show', [$group, $student])}}">{{$student->id}}</a></div>
                    </td>
                    <td>
                        <div>{{$student->surname}}</div>
                    </td>
                    <td>
                        <div>{{$student->name}}</div>
                    </td>
                    <td>
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
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
