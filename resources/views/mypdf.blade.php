<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
</head>
<body>
    <h1></h1>
    <p></p>
    
    @foreach($data as $info)
    <p>{{$info->name}}</p>
    @endforeach
</body>
</html>