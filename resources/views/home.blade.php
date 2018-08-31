@extends('layouts.app')
@section('content')
    <form action="" method="get">
        <div class="row">
            <div class="col">Sort by:</div>
            <div class="col">
                <label>
                    @if ($request->sort == 'name')
                        <input type="radio" name="sort" value="name" checked> Name
                    @else
                        <input type="radio" name="sort" value="name"> Name
                    @endif
                </label>
            </div>
            <div class="col">
                <label>
                    @if ($request->sort == 'surname')
                        <input type="radio" name="sort" value="surname" checked> Surname
                    @else
                        <input type="radio" name="sort" value="surname"> Surname
                    @endif
                </label>
            </div>
            <div class="col">
                <label>
                    @if ($request->sort == 'patronymic')
                        <input type="radio" name="sort" value="patronymic" checked> Patronymic
                    @else
                        <input type="radio" name="sort" value="patronymic"> Patronymic
                    @endif
                </label>
            </div>
            <div class="col">
                <label>
                    @if ($request->sort == 'birth_date')
                        <input type="radio" name="sort" value="birth_date" checked> Birth Date
                    @else
                        <input type="radio" name="sort" value="birth_date"> Birth Date
                    @endif
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col">Search student by:</div>
            <div class="col">
                <input type="text" name="name" id="name" class="form-control" placeholder="name" value="{{isset($request->name)?$request->name: null }}">
            </div>
            <div class="col">
                <input type="text" name="surname"class="form-control" placeholder="surname" value="{{isset($request->surname)?$request->surname: null }}">
            </div>
            <div class="col">
                <input type="text" name="patronymic" class="form-control" placeholder="patronymic" value="{{isset($request->patronymic)?$request->patronymic: null }}">
            </div>
            <div class="col">
                <select title="Group" class="custom-select" name="group_id">
                    <option selected value="">Group:</option>
                    @foreach($groups as $group)
                        @if (isset($request->group_id) && $group->id == $request->group_id)
                            <option selected value="{{$group->id}}">Group {{$group->name}}</option>
                        @else
                            <option value="{{$group->id}}">Group {{$group->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="text" name="per_page" class="form-control" placeholder="Per Page" value="{{isset($request->per_page)?$request->per_page: null }}">
            </div>
            <div class="col">
                <button class="btn btn-info">Search</button>
            </div>
            <div class="col">
                <a href="{{url('/')}}" name="reset" class="btn btn-info">Reset filters</a>
            </div>
        </div>
        <div class="row">
            @foreach($subjects as $subject)
                @php
                    if (isset($request->{'avg' . $subject->id})) {
                        $parameters = explode('-', $request->{'avg'.$subject->id});
                    } else {
                        $parameters = [0, 5];
                    }
                    $parameters['id'] = $subject->id;
                    $parameters['name'] = $subject->name;
                @endphp

                <slider-component :parameters="{{json_encode($parameters)}}"></slider-component>
                {{--<script>--}}
                    {{--jQuery.noConflict();--}}
                    {{--jQuery( function($) {--}}
                        {{--$( "#slider{{$subject->id}}" ).slider({--}}
                            {{--range: true,--}}
                            {{--min: 0,--}}
                            {{--max: 5,--}}
                            {{--values: ["<? echo $parameters[0] ?>", "<? echo $parameters[1] ?>"],--}}
                            {{--step: 0.1,--}}
                            {{--slide: function( event, ui ) {--}}
                                {{--$( "#avg{{$subject->id}}" ).val( ui.values[ 0 ] + "-" + ui.values[ 1 ] );--}}
                            {{--}--}}
                        {{--});--}}
                    {{--} );--}}
                {{--</script>--}}
                {{--<div class="col">--}}
                    {{--<label for="avg{{$subject->id}}">Average mark for {{$subject->name}}</label>--}}
                    {{--@if(isset($request->{'avg' . $subject->id}))--}}
                        {{--<input type="text" id="avg{{$subject->id}}" name="avg{{$subject->id}}" value="@php echo $request->{'avg'.$subject->id}; @endphp" readonly style="border:0; color:#f6931f; font-weight:bold;">--}}
                    {{--@else--}}
                        {{--<input type="text" id="avg{{$subject->id}}" name="avg{{$subject->id}}" readonly style="border:0; color:#f6931f; font-weight:bold;">--}}
                    {{--@endif--}}
                    {{--<div id="slider{{$subject->id}}"></div>--}}
                {{--</div>--}}
            @endforeach
        </div>
    </form>
    <table class="table table-bordered table-sm">
        <thead>
        <tr>
            <th scope="col">Group</th>
            <th scope="col">Avatars</th>
            <th scope="col">Students</th>
            <th scope="col">Date of Birth</th>
            @foreach($subjects as $subject)
                <th scope="col">{{$subject->name}}</th>
            @endforeach
            <th scope="col">Average Rating</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{$student->group->name}}</td>
                <td><img src="/avatars/{{$student->avatar}}" style="width: 50px; height: 50px; border-radius: 50%"></td>
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
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$paginatedCollection->render()}}
@endsection
