@extends('layouts.app')
@section('content')
    <table class="table table-bordered">
        <thead>
        Subjects:
        <th>Id</th>
        <th>Name</th>
        </thead>

        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td class="table-text">
                    <div>{{$subject->id}}</div>
                </td>
                <td class="table-text">
                    <div>{{$subject->name}}</div>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
