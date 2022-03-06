<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product cart-login</title>

    <!--custom style link-->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
    <div class="form-container">
        <form action="./controller/login.php" method="post">
            <label for="">Email:</label>
            <input type="email" name="email"  class="box" placeholder="Email" required>
            <label for="">Password:</label>
            <input type="password" name="password" class="box" placeholder="Password" required>
            <input type="submit" value="Login" name="login" class="btn">
            <p>Don't have an account yet?<a href="./register.php">Register</a></p>
        </form>
    </div>
</body>
</html>