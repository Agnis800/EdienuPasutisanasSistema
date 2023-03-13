<!DOCTYPE html>
<?php
    $nameErr = $surnameErr = $emailErr = $messageErr = '';
    $name = $surname = $email = $subject = $message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
          } else {
            $name = test_input($_POST["name"]);
          }
        if (empty($_POST["surname"])) {
            $surnameErr = "Surname is required";
          } else {
            $surname = test_input($_POST["surname"]);
          }
        if (empty($_POST["e-mail"])) {
            $emailErr = "E-mail is required";
          } else {
            $email = test_input($_POST["e-mail"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
}
          }
        $subject = test_input($_POST["subject"]);
        if (empty($_POST["message"])) {
            $messageErr = "Message is required";
          } else {
            $message = test_input($_POST["message"]);
          }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="assets/css/contactform.css"/>
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <p><span class="error">* required field</span></p>
        <div class="container">
            <h1>Contact us</h1>

            <label for="name"><b>Name</b></label>
            <span class="error">* <?php echo $nameErr;?></span>
            <input type="text" name="name" id="name" value="<?php echo $name;?>">

            <label for="surname"><b>Surname</b></label>
            <span class="error">* <?php echo $surnameErr;?></span>
            <input type="text" name="surname" id="surname" value="<?php echo $surname;?>">

            <label for="e-mail"><b>E-mail</b></label>
            <span class="error">* <?php echo $emailErr;?></span>
            <input type="text" name="e-mail" id="e-mail" value="<?php echo $email;?>">

            <label for="subject"><b>Subject</b></label>
            <input type="text" name="subject" id="subject" value="<?php echo $subject;?>">

            <label for="message"><b>Message</b></label>
            <span class="error">* <?php echo $messageErr;?></span>
            <textarea id="message" name="message" style="height:200px"><?php echo $message;?></textarea>
        </div>

        <button type="submit" class="submitbtn">Submit</button>
    </form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $surname;
echo "<br>";
echo $email;
echo "<br>";
echo $subject;
echo "<br>";
echo $message;
?>
</body>
</html>