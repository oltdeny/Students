@extends('layouts.app')
@section('content')
    @include('errors')
    <form action="{{route('groups.students.marks.update', [$group, $student, $mark])}}" method="post">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div>
            <label for="mark" class="col-sm-3 control-label">Mark:
                <select name="mark">
                    <option selected value="{{$mark->id}}">{{$mark->mark}}</option>
                    @for($i = 1; $i <= 5; $i++)
                        @if($i == $mark->mark)
                            @continue
                        @endif
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </label>
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i>
                Edit mark
            </button>
        </div>
    </form>
@endsection