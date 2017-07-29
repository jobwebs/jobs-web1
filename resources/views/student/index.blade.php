<!doctype html>
<html>
<title>I am index</title>
<body>
<p>I am index</p>
<form>

</form>
@foreach($students as $student)
<p>{{$student->id}}</p><br/>
@endforeach
<div>
    {{$students->render()}}
</div>
</body>
</html>