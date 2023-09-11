@extends('topics.layouts')

@section('content')
<form action="{{route('topics.update',$topic->id)}}" method='POST'>
@csrf
@method('PUT')
<label for="title">title</label><br>
<input type="text" name="title" placeholder="enter the title" value={{$topic->title}} ><br>

<label for="description">description</label><br>
<input type="text" name="description" placeholder="type the description" value={{$topic->description}}><br>

<button type="submit">submit</button>
</form>

    
@endsection