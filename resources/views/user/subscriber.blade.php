<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action='/user/subscriber' method="POST">
        @csrf
        
    <label for="topic">choose topics for the newsletter</label><br>
       <label for="topic">travel</label>
       <input type="checkbox" name ="topics[]" value="Travel"><br>
       <label for="topic">tech</label>
       <input type="checkbox" name ="topics[]" value="tech"><br>
       <label for="topic">health</label>
       <input type="checkbox" name ="topics[]" value="health"> <br>
       <label for="topics">youtube<label>
       <input type="checkbox" name ="topics[]" value="youtube"> <br><br><br>    
       <input type="email" name="email">

       <button type="submit">subscribe</button>
    
    </form>
</body>
</html>