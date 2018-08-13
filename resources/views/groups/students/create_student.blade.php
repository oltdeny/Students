@extends('layouts.app')
@section('content')
    @include('errors')
    <form action="{{route('groups.students.store', $group)}}" method="post">
        {{csrf_field()}}
        <label for="name" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-6">
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <label for="surname" class="col-sm-3 control-label">Surname</label>
        <div class="col-sm-6">
            <input type="text" name="surname" id="name" class="form-control">
        </div>
        <label for="patronymic" class="col-sm-3 control-label">Patronymic</label>
        <div class="col-sm-6">
            <input type="text" name="patronymic" id="name" class="form-control">
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i>
                Add student
            </button>
        </div>
    </form>
@endsection