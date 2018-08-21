@extends('layouts.app')
@section('content')
    <form action="{{route('search')}}" method="post">
        @csrf
        <label for="name">Search student by:</label>
        <div class="row">
            <div class="col">
                <input type="text" name="name" id="name" class="form-control" placeholder="name">
            </div>
            <div class="col">
                <input type="text" name="surname"class="form-control" placeholder="surname">
            </div>
            <div class="col">
                <input type="text" name="patronymic" class="form-control" placeholder="patronymic">
            </div>
            <div class="col">
                <select title="Group" class="custom-select" name="group_id">
                    @foreach($groups as $group)
                        <option value="{{$group->id}}">Group {{$group->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button class="btn btn-info">Search</button>
            </div>
        </div>
    </form>
        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th scope="col">Group</th>
                <th scope="col">Students</th>
                <th scope="col">Date of Birth</th>
                @foreach($subjects as $subject)
                    <th scope="col">{{$subject->name}}</th>
                @endforeach
                <th scope="col">Average Rating</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->group->name}}</td>
                            <td>{{$student->name}} {{$student->surname}} {{$student->patronymic}}</td>
                            <td>{{$student->birth_date}}</td>
                            @foreach($subjects as $subject)
                                <td>
                                    {{$student->marks->where('subject_id', $subject->id)->avg('mark')}}
                                </td>
                            @endforeach
                            <td>
                                {{$student->marks->avg('mark')}}
                            </td>
                            <td>
                                <form action="{{route('groups.students.show', [$student->group, $student])}}" method="post">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-danger" disabled>Delete</button>
                                </form>
                                <form action="{{route('groups.students.show', [$student->group, $student])}}" method="post">
                                    @csrf
                                    <button class="btn btn-outline-info" disabled>Анкета</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    {{$students->links()}}
@endsection
