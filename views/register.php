<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css"/>
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
    <form action="action_page.php">
        <div class="container">
            <h1>Register</h1>

            <label for="username"><b>Username</b></label>
            <input type="text" name="username" id="username" required>

            <label for="email"><b>Email</b></label>
            <input type="text" name="e-mail" id="e-mail" required>

            <label for="phone-number"><b>Phone number</b></label>
            <input type="text" name="phone-number" id="phone-number" required>

            <label for="password"><b>Password</b></label>
            <input type="password" name="password" id="password" required>

            <label for="confirm_password"><b>Confirm password</b></label>
            <input type="password" name="confirm_password" id="confirm_passowrd" required>
        </div>

        <button type="submit" class="registerbtn">Register</button>
        <div class="container signin">
            <p>Already have an account? <a href="/login">Log in</a>.</p>
        </div>
    </form>
</body>
</html>