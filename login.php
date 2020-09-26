<?php include('server.php'); ?>
<!DOCTYPE html>
<html>

</head>
<title>Login</title>
</head>


<body>
    <h1>Log In</h1>

    <!-- Form start -->
    <form action="login.php" method="post">
        <?php include('error.php'); ?>
        Email: <input type="text" name='email' value='<?php echo $email; ?>' >
        <!-- <span class="error">* <?php echo $emailErr; ?></span> -->
        </br>
        </br>
        Password: <input type="password" name='password' >
        <!-- <span class='error'>* <?php echo $passErr; ?></span> -->
        </br>
        </br>
        <input type="submit" name='login_user'>
        </br>
        </br>
        <p> Don't have an account? <span style="color:blueviolet;"> <a href="register.php">Sign up</a> </span>
    </form>
    <!-- Form end -->

</body>

</html>