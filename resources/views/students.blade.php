@extends('layouts.app')
@section('content')
    <table class="table table-bordered">
        <thead>
        Students of group: {{$groupName}}
        <th>Id</th>
        <th>Surname</th>
        <th>Name</th>
        <th>Patronymic</th>
        </thead>

        <tbody>
        @foreach($students as $student)
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
    </table>
@endsection
