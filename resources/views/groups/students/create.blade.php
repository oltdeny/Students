@extends('layouts.app')
@section('content')
    @include('errors')
    <form action="{{route('groups.students.store', $group)}}" method="post">
        @csrf
        <label for="name" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-6">
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>
        <label for="surname" class="col-sm-3 control-label">Surname</label>
        <div class="col-sm-6">
            <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname') }}">
        </div>
        <label for="patronymic" class="col-sm-3 control-label">Patronymic</label>
        <div class="col-sm-6">
            <input type="text" name="patronymic" id="patronymic" class="form-control" value="{{ old('patronymic') }}">
        </div>
        <label for="birth_date" class="col-sm-3 control-label">Date of Birth</label>
        <div class="col-sm-6">
            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date') }}">
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i>
                Add student
            </button>
        </div>
    </form>
@endsection