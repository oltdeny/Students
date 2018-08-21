@extends('layouts.app')
@section('content')
    <form action="{{route('groups.create')}}" method="get">
        @csrf
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success" disabled>
                Add group
            </button>
        </div>
    </form>
    Groups:
    <table class="table table-bordered table-sm">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Average Rating</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)
            <tr>
                <td class="table-text">
                    <div><a href="{{route('groups.show', $group)}}">{{$group->name}}</a></div>
                </td>
                <td class="table-text">
                    <div>{{$group->description}}</div>
                </td>
                <td>
                    <table class="table table-bordered table-sm">
                        @foreach($subjects as $subject)
                            <tr>
                                <th scope="row">{{$subject->name}}:</th>
                                <td>
                                    @php
                                        echo $avgs[$loop->parent->index]->{$subject->id}
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <th scope="row">General Average:</th>
                                <td>{{$avgs[$loop->index]->avg}}</td>
                            </tr>
                    </table>
                </td>
                <td>
                    <form action="{{route('groups.destroy', $group)}}" method="post">
                        @csrf
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger" disabled>Delete current Group</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$groups->links()}}

@endsection

