<?php

// session_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$name = "";
$email = "";
$password = "";
$errors = array();

// Create connection
$conn = new mysqli($servername, 'root', '', 'practice');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";


/////////////////////////////////////// On Register start //////////////////////////////////////////
if (isset($_POST['register_user'])) {
    $name = mysqli_escape_string($conn, $_POST['name']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);
    $passwordConfiramtion = mysqli_escape_string($conn, $_POST['passwordConfirmation']);

    // validating inputs
    //////////// validating name
    if (empty($name)) {
        array_push($errors, 'Name is required');
    } elseif (strlen($name) < 6) {
        array_push($errors, 'Name must be atleast 6 charcters in length');
    }
    //////////////// validating email
    if (empty($email)) {
        array_push($errors, 'Email is required');
    } elseif (strlen($email) < 12 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Invalid email format');
    }
    //////////////// validating password
    if (empty($password)) {
        array_push($errors, 'Password is required');
    } elseif (strlen($password) < 6) {
        array_push($errors, 'Password must be atleast 6 charcters in length');
    } else {
        // $passToCheck = explode("", $password);
        // foreach ($passToCheck as $i) {
        //     echo $i;
        // }
        $passUniqCharCount = 0;

        for ($i = 0; $i < strlen($password); $i++) {
            echo $password[$i];
            if (ctype_upper($password[$i]) || ctype_digit($password[$i]) || ctype_punct($password[$i])) {
                $passUniqCharCount++;
            }
        }

        if ($passUniqCharCount < 3) array_push($errors, 'Password must contain at least one numeric, one uppercase and one special character');
    }
    //////////////// validating passwordConfiramtion
    if (empty($passwordConfiramtion)) {
        array_push($errors, 'Password confirmation is required');
    }
    if ($passwordConfiramtion != $password) {
        array_push($errors, 'Password\'s must match');
    }

    // check if user already exists with same email id 
    $check = "SELECT * FROM users WHERE email='$email'";
    $check_result = mysqli_query($conn, $check);
    $user = mysqli_fetch_assoc($check_result);

    if ($user != null) {
        if ($user['email'] == $email) {
            array_push($errors, 'Account already exists with this email address');
        }
    }

    if (count($errors) == 0) {
        // ecrypting password before insering to db
        $password = md5($passwordConfiramtion);

        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        $_SESSION['name'] = $result['name'];
        $_SESSION['success'] = 'You are now logged in';
        header('location: index.php');
    }
}
/////////////////////////////////////// On Register end //////////////////////////////////////////


/////////////////////////////////////// On Login start //////////////////////////////////////////
if (isset($_POST['login_user'])) {
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);

    // validating inputs
    //////////// validating email
    if (empty($email)) {
        array_push($errors, 'Email is required');
    } elseif (strlen($email) < 12) {
        array_push($errors, 'Invalid email format');
    } else {
        $emailValidityCount = 0;

        for ($i = 0; $i < strlen($email); $i++) {
            // echo $email[$i];
            if (($email[$i] == '.' || $email[$i] == '@')) {
                $emailValidityCount++;
            }
        }

        if ($emailValidityCount != 2) array_push($errors, 'Invalid email format');
    }
    //////////// validating password
    if (empty($password)) {
        array_push($errors, 'Password is required');
    }


    if (count($errors) == 0) {
        // ecrypting password before checking
        $password = md5($password);
        $sqlEmail = "SELECT * FROM users WHERE email='$email'";
        $sqlEmailAndPass = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $resultsEmail = mysqli_query($conn, $sqlEmail);
        $resultsEmailAndPass = mysqli_query($conn, $sqlEmailAndPass);
        $userEmail = mysqli_fetch_assoc($resultsEmail);
        $userEmailAndPass = mysqli_fetch_assoc($resultsEmailAndPass);

        if (mysqli_num_rows($resultsEmail) != 1) {
            array_push($errors, "User doesn't exist with this email");
        } elseif (mysqli_num_rows($resultsEmailAndPass) != 1) {
            array_push($errors, "Incorrect password");
        } else {
            $_SESSION['name'] = $userEmailAndPass['name'];
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
        // else {
        //     array_push($errors, "Wrong username/password combination");
        // }
    }
}
/////////////////////////////////////// On Login end //////////////////////////////////////////

// email password error, manually check, instead of required (also did instead of html input type)
// check for password length, email length char ...
// email validation chaecked manuaally also with filter_var function
// show errors...
// aaS12!@
// show specific error - email or password which is invalid
