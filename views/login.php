<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css"/>
</head>
<body>
    <header>
        <div class="title">
            <h2>AV FOOD</h2>
        </div>
        <div class="pages">
          <a href="/">Catalogue</a>
          <a href="">Your account</a>
          <a href="/contactform">Contact us</a>
        </div>
        <button class="button"><a href="/cart">Your cart</a></button>
        <button class="button"><a href="/login">Login</a></button>
        <button class="button"><a href='/register'>Register</a></button>
    </header>
    <hr>
    <form action="/login">
        <div class="container">
            <h1>Login</h1>

            <label for="username"><b>Username</b></label>
            <input type="text" name="username" id="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" name="password" id="password" required>

        </div>

        <button type="submit" class="loginbtn">Login</button>
        <div class="container signin">
            <p>Don't have an account? <a href="/register">Register</a>.</p>
        </div>
    </form>    
</body>
</html>