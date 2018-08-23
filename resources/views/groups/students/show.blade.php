@extends('layouts.app')
@section('content')
    <div style="display: inline-block">
        <form action="{{route('groups.students.marks.create', [$group, $student])}}" method="get">
            @csrf
            <button class="btn btn-success">Add Mark</button>
        </form>
    </div>
    <div style="display: inline-block">
        <form action="{{route('groups.students.edit', [$group, $student])}}" method="get">
            @csrf
            <button class="btn btn-info">Edit current Student</button>
        </form>
    </div>
    <div style="display: inline-block">
        <a href="{{route('groups.show', $group)}}" class="btn btn-info">Back to Group</a>
    </div>
    <div>
        <div style="display: inline-block">
            <img src="/avatars/{{$student->avatar}}" style="width: 150px; height: 150px; border-radius: 50%; margin-right: 20px">
        </div>
        <div style="display: inline-block">
            <div> Group: {{$group->name}}</div>
            Full name:
            <div>{{$student->surname}}</div>
            <div>{{$student->name}}</div>
            <div>{{$student->patronymic}}</div>
        </div>
    </div>
    <form action="{{route('groups.students.addPhoto', [$group, $student])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="avatar" name="avatar">
            <label class="custom-file-label" for="avatar">Choose file</label>
        </div>
        <div>
            <button class="btn">Submit</button>
        </div>
    </form>
    <div>
        <table class="table table-bordered">
            <thead>Marks:</thead>
            <tbody>
            <tr>
                @foreach($subjects as $subject)
                    <td>
                        {{$subject->name}}:
                        @foreach($student->marks->where('subject_id', $subject->id) as $mark)
                            <div>
                                <a href="{{route('groups.students.marks.edit', [$group, $student, $mark])}}">{{$mark->mark}}</a>
                            </div>
                        @endforeach
                        Average Rating for {{$subject->name}}:
                        <div>{{$student->marks->where('subject_id', $subject->id)->avg('mark')}}</div>
                    </td>
                @endforeach
            </tr>
            </tbody>
        </table>
        <div>
            Average rating: {{$student->marks->avg('mark')}}
        </div>
    </div>
@endsection
