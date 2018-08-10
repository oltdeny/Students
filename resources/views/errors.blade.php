@if(count($errors)>0)
    <div class="alert alert-danger">
    <strong>Something went wrong!</strong>
    @foreach($errors->all() as $error)
        <ul>
            <li>{{$error}}</li>
        </ul>
    @endforeach
    </div>
@endif