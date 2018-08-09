@extends('layouts.app')
@section('content')
    @foreach($groups as $group)
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
            @if(isset($studentsOfGroup))
                @foreach($studentsOfGroup[$group->id - 1] as $student)
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
                @endforeach
            @else
                @php
                    $i = 0
                @endphp
                @foreach($students as $student)
                    @for(;$i < count($marks); $i++)
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
                                @foreach($marks[$i] as $markForSubject)
                                    <span style="padding: 2px; background: rgba(198,225,255,0.91); margin: 3px">
                                        {{\App\Models\Subject::where('id', $markForSubject->subject_id)->value('name')}}:
                                        {{$markForSubject->mark}}
                                    </span>
                                @endforeach
                            </td>
                        </tr>
                    @endfor
                @endforeach
            @endif
        </table>
    @endforeach
@endsection
