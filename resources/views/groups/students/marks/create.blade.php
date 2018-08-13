@extends('layouts.app')
@section('content')
    @include('errors')
    <form action="{{route('groups.students.marks.store', [$group, $student])}}" method="post">
        {{csrf_field()}}
        <div>
            <label for="subject" class="col-sm-3 control-label">Subject:
                <select name="subject">
                    @foreach($subjects as $subject)
                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div>
            <label for="mark" class="col-sm-3 control-label">Mark:
                <select name="mark">
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </label>
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i>
                Add mark
            </button>
        </div>
    </form>
@endsection