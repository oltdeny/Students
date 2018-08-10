@extends('layouts.app')
@section('content')
    @include('errors')
    <form action="{{route('groups.update', $group)}}" method="post">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <label for="name" class="col-sm-3 control-label">Group name</label>
        <div class="col-sm-6">
            <input type="text" name="name" id="name" class="form-control" value="{{$group->name}}">
        </div>
        <label for="description" class="col-sm-3 control-label">Group description</label>
        <div class="col-sm-6">
            <textarea name="description" id="description" class="form-control">{{$group->description}}</textarea>
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i>
                Edit group
            </button>
        </div>
    </form>
@endsection