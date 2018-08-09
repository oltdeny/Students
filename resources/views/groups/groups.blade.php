@extends('layouts.app')
@section('content')
    <table class="table table-bordered">
        <thead>
        Groups:
        <th>Id</th>
        <th>Name</th>
        <th>Discription</th>
        </thead>

        <tbody>
        @foreach($groups as $group)
            <tr>
            <td class="table-text">
                <div>{{$group->id}}</div>
            </td>
            <td class="table-text">
                <div><a href="{{route('groups.show', $group)}}">{{$group->name}}</a></div>
            </td>
            <td class="table-text">
                <div>{{$group->description}}</div>
            </td>
            </tr>
        @endforeach
    </table>
    <form action="{{route('groups.create')}}">

    </form>
@endsection
