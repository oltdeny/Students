<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<body>
<nav class="nav">
    <div style="display: inline-block"><a href="{{url('/')}}" class="nav-link">Main</a></div>
    <div style="display: inline-block"><a href="{{route('groups.index')}}" class="nav-link">Groups</a></div>
    <div style="display: inline-block"><a href="{{route('subjects.index')}}" class="nav-link">Subjects</a></div>
    <div style="display: inline-block"><a href="{{route('groups.students.index', 0)}}" class="nav-link">Outstanding students</a></div>
</nav>
<hr>
<div class="container">
    @yield('content')
</div>
</body>
</html>