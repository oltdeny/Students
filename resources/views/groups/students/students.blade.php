@extends('layouts.app')
@section('content')
<div style="display: inline-block">
    Achievers:
    <table class="table table-bordered table-sm">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Patronymic</th>
            <th>Date of Birth</th>
            <th>Group</th>
        </tr>
        </thead>
        <tbody>
        @foreach($achievers as $achiever)
            <tr class="bg-success">
                <td>
                    <div><a href="{{route('groups.students.show', [$achiever->group, $achiever])}}">{{$achiever->name}}</a></div>
                </td>
                <td>
                    <div>{{$achiever->surname}}</div>
                </td>
                <td>
                    <div>{{$achiever->patronymic}}</div>
                </td>
                <td>
                    <div>{{$achiever->birth_date}}</div>
                </td>
                <td>
                    {{$achiever->group->name}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div style="display: inline-block">
    Good:
    <table class="table table-bordered table-sm">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Patronymic</th>
            <th>Date of Birth</th>
            <th>Group</th>
        </tr>
        </thead>
        <tbody>
        @foreach($goods as $good)
            <tr class="bg-warning">
                <td>
                    <div><a href="{{route('groups.students.show', [$good->group, $achiever])}}">{{$good->name}}</a></div>
                </td>
                <td>
                    <div>{{$good->surname}}</div>
                </td>
                <td>
                    <div>{{$good->patronymic}}</div>
                </td>
                <td>
                    <div>{{$good->birth_date}}</div>
                </td>
                <td>
                    {{$good->group->name}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
