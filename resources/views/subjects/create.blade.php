@extends('layouts.app')
@section('content')
    @include('errors')
    <form action="{{route('subjects.store')}}" method="post">
        @csrf
        <label for="name" class="col-sm-3 control-label">Subject name:</label>
        <div class="col-sm-6">
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i>
                Add subject
            </button>
        </div>
    </form>
@endsection