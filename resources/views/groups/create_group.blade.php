@extends('layouts.app')
@section('content')
    @include('errors')
<form action="{{route('students.store')}}" method="post">
    {{csrf_field()}}
    <label for="name" class="col-sm-3 control-label">Group name</label>
    <div class="col-sm-6">
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <label for="description" class="col-sm-3 control-label">Group description</label>
    <div class="col-sm-6">
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="col-sm-6">
        <button type="submit" class="btn btn-success">
            <i class="fa fa-plus"></i>
            Add group
        </button>
    </div>
</form>
@endsection