<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
</head>

<body>
    @auth
    <p>Congrates you are logged in 🎉</p>
    <form action="/logout" method="POST">
    @csrf
    <input type="submit" value="Log Out">
</form>

<hr>
<h2> Creating Post</h2>
<form action="/create-post" method="POST" >
    @csrf
    Title: <input type="text" name="title">
    Body: <textarea name="body" cols="20"> </textarea>
    <input type="submit" value="Post">
</form>

<hr>
@foreach ($posts as $post) 
    <div style="border: 3px solid black; padding: 25px; margin-top: 10px; max-width: 50%;border-radius: 15px;">
        <h4>{{$post['title']}}</h4>
        <br>
        <p>{{$post['body']}}</h4>
        <br>
        <hr>
        <div style="display: flex; flex-direction: row;">
            <a href="/post-detail/{{$post->id}}" style="margin-right: 10px;">Edit</a>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" style="background-color:rgb(219, 145, 145)">
            </form>
        </div>
    </div>
@endforeach
<div>
    
</div>


    @else
    <div style="border: 3px solid black; padding: 25px;">
        <h2> Register Form</h2>
        <form action="/register" method="POST">
            @csrf
            Username: <input type="text" name="name">
            Email: <input type="text" name="email">
            Password: <input type="password" name="password">
            <input type="submit" value="Register">
        </form>
    </div>

    <br><br>

    <div style="border: 3px solid green; padding: 25px;">
        <h2>Login Form</h2>
        <form action="/login" method="POST">
            @csrf
            Email: <input type="text" name="loggedInEmail">
            Password: <input type="password" name="loggedInPassword">
            <input type="submit" value="Login">
        </form>
    </div>
    @endauth

   

</body>

</html>