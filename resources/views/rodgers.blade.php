<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>I am a rodgers a page </title>
</head>
<body>
    <h1>Users</h1>
    <ul>
        @foreach($users as $task)
            <li>{{ $task->title }}</li>
        @endforeach
    </ul>
</body>
</html>