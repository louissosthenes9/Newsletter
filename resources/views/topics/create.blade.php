@extends('topics.layouts')

@section('content')
<form action={{route('topics.store')}} method='POST'>
@csrf
<label for="title">title</label><br>
<input type="text" name="title" placeholder="enter the title"><br>

<label for="description">description</label><br>
<input type="text" name="description" placeholder="type the description"><br>

<button type="submit">submit</button>
</form>

    
@endsection