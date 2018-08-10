@extends('layouts.app')
@section('content')
    <form action="{{route('groups.create')}}" method="get">
        {{csrf_field()}}
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success">
                Add group
            </button>
        </div>
    </form>
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
                <div style="display: inline-block"><a href="{{route('groups.show', $group)}}">{{$group->name}}</a></div>
                <div style="display: inline-block">
                    <form action="{{route('groups.destroy', $group)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger">Delete</button>
                    </form>
                    <form action="{{route('groups.edit', $group)}}" method="get">
                        {{csrf_field()}}
                        <button class="btn btn-info">Edit</button>
                    </form>
                </div>
            </td>
            <td class="table-text">
                <div>{{$group->description}}</div>
            </td>
            </tr>
        @endforeach
    </table>
@endsection
