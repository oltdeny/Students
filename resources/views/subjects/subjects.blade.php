@extends('layouts.app')
@section('content')
    @if(Auth::user()->is_admin)
    <div>
        <form action="{{route('subjects.create')}}" method="get">
            @csrf
            <button class="btn btn-success">Add Subject</button>
        </form>
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
        Subjects:
        </thead>

        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td class="table-text">
                    <div style="display: inline-block">{{$subject->name}}</div>
                    @if(Auth::user()->is_admin)
                    <div style="display: inline-block">
                        <form action="{{route('subjects.destroy', $subject)}}" method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection
