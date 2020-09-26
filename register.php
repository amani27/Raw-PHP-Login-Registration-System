<?php include('server.php'); ?>
<!DOCTYPE html>
<html>

</head>
<title>Register</title>
</head>


<body>
    <h1>Register</h1>

    <!-- Form start -->
    <form action="register.php" method="post">
        <?php include('error.php'); ?>
        Name: <input type="text" name='name' value='<?php echo $name; ?>'>
        </br>
        </br>
        Email: <input type="text" name='email' value='<?php echo $email; ?>'>
        </br>
        </br>
        Password: <input type="password" name='password'>
        </br>
        </br>
        Confirm Password: <input type="password" name='passwordConfirmation'>
        </br>
        </br>
        <input type="submit" name='register_user'>
        </br>
        </br>
        <p> Already a member? <span style="color:blueviolet;"> <a href="login.php"> Sign in</a> </span>
    </form>
    <!-- Form end -->

</body>

</html>