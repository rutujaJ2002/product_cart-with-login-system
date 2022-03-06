<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product cart-register</title>

    <!--custom style link-->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
    <div class="form-container">
        <form action="./controller/register.php" method="post">
            <label for="">Username:</label>
            <input type="text" name="username"  class="box" placeholder="Username" required>
            <label for="">Email:</label>
            <input type="email" name="email" class="box" placeholder="Email" required>
            <label for="">Password:</label>
            <input type="password" name="password" class="box" placeholder="Password" required>
            <label for="">Confirm Password:</label>
            <input type="password" name="cpassword" class="box" placeholder="Confirm Password" required>

            <input type="submit" value="Register" name="register" class="btn">
            <p>Already have an account?<a href="./login.php">Login</a></p>
        </form>
    </div>
</body>
</html>