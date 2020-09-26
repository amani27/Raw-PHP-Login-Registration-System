<?php
session_start();

if (!isset($_SESSION['name'])) {
    $_SESSION['msg'] = 'You must first log in to view this page';
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['name']);
    header('location: login.php');
}

?>

<!DOCTYPE html>

</head>
<title>Homepage</title>
</head>

<body>
    <h1> Home </h1>

    <?php include('error.php'); ?>
    <?php if (count($errors) > 0) : ?>
        <h3>
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </h3>
    <?php endif ?>

    <?php if (isset($_SESSION['name'])) : ?>
        <h3 style="color:purple;"> Welcome
            <strong>
                <?php
                echo $_SESSION['name'];
                ?>
            </strong>
        </h3>
        <button><a href="index.php?logout='1'">Log Out</a></button>
    <?php endif ?>


</body>

</html>