@extends('layouts.app')
@section('content')
    @include('errors')
    <form action="{{route('groups.students.update', [$currentGroup, $student])}}" method="post">
        @csrf
        {{method_field('PUT')}}
        <label for="name" class="col-sm-3 control-label">Name</label>
        <div class="col-sm-6">
            <input type="text" name="name" id="name" class="form-control" value="{{$student->name}}">
        </div>
        <label for="name" class="col-sm-3 control-label">Surname</label>
        <div class="col-sm-6">
            <input type="text" name="surname" id="name" class="form-control" value="{{$student->surname}}">
        </div>
        <label for="name" class="col-sm-3 control-label">Patronymic</label>
        <div class="col-sm-6">
            <input type="text" name="patronymic" id="name" class="form-control" value="{{$student->patronymic}}">
        </div>
        <label for="birth_date" class="col-sm-3 control-label">Date of Birth</label>
        <div class="col-sm-6">
            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{$student->birth_date}}">
        </div>
        <div class="col-sm-6">
            <label for="group_id">
                Group:
                <select name="group_id">
                    <option selected value="{{$currentGroup->id}}">{{$currentGroup->name}}</option>
                    @foreach($groups as $group)
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i>
                Edit student
            </button>
        </div>
    </form>
@endsection