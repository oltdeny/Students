@extends('layouts.app')
@section('content')
    <form action="" method="get">
        <label for="name">Search student by:</label>
        <div class="row">
            <div class="col">
                <input type="text" name="name" id="name" class="form-control" placeholder="name" value="{{isset($filter->name)?$filter->name: null }}">
            </div>
            <div class="col">
                <input type="text" name="surname"class="form-control" placeholder="surname" value="{{isset($filter->surname)?$filter->surname: null }}">
            </div>
            <div class="col">
                <input type="text" name="patronymic" class="form-control" placeholder="patronymic" value="{{isset($filter->patronymic)?$filter->patronymic: null }}">
            </div>
            <div class="col">
                <select title="Group" class="custom-select" name="group_id">
                    <option disabled selected>Group:</option>
                    @foreach($groups as $group)
                        <option value="{{$group->id}}">Group {{$group->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="text" name="per_page" class="form-control" placeholder="Per Page" value="{{isset($filter->per_page)?$filter->per_page: null }}">
            </div>
            <div class="col">
                <button class="btn btn-info">Search</button>
            </div>
            <div class="col">
                <input type="submit" name="reset" class="btn btn-info" value="Reset filters">
            </div>
        </div>
        <div class="row">
            @foreach($subjects as $subject)
                @php
                    if (isset($filter->{'avg' . $subject->id})) {
                        $parameters = explode('-', $filter->{'avg'.$subject->id});
                    } else {
                        $parameters = [0, 5];
                    }
                @endphp
                <script>
                    jQuery.noConflict();
                    jQuery( function($) {
                        $( "#slider{{$subject->id}}" ).slider({
                            range: true,
                            min: 0,
                            max: 5,
                            values: ["<? echo $parameters[0] ?>", "<? echo $parameters[1] ?>"],
                            step: 0.1,
                            slide: function( event, ui ) {
                                $( "#avg{{$subject->id}}" ).val( ui.values[ 0 ] + "-" + ui.values[ 1 ] );
                            }
                        });
                    } );
                </script>
                <div class="col">
                    <p>
                        <label for="avg{{$subject->id}}">Average mark for {{$subject->name}}</label>
                        @if(isset($filter->{'avg' . $subject->id}))
                            <input type="text" id="avg{{$subject->id}}" name="avg{{$subject->id}}" value="@php echo $filter->{'avg'.$subject->id}; @endphp" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        @else
                            <input type="text" id="avg{{$subject->id}}" name="avg{{$subject->id}}" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        @endif

                    </p>
                    <div id="slider{{$subject->id}}"></div>
                </div>
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
