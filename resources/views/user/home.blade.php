<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Page</title>
</head>
<body>
    <h1>User Page </h1>
   <form action="{{ route('logout') }}" method="POST">
@csrf
<input type="submit" value="Logout">
   </form>
</body>
</html>