
<html>

<head>
    <title> Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="color"></div>
    <div id="color2"></div>

    <div class="container">
        <div class="row">
            <div class="col"></div>
            <h2> Register</h2>
            <form action="<?php $PHP_SELF; ?>" method="post">
                <div class="form-object">
                    <label>Username</label>
                    <input type="text" name="user" class="form-control" required>
                </div>
                <div class="form-object">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-object">
                    <label>Password</label>
                    <input type="password" name="password2" class="form-control" required>
                </div>
                <p id="message"></p>
                <button type="submit" name="submit" class="btn btn-primary"> Register </button>
            </form>
            <a href="login.php" id="login">login </a>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>

<?php

session_start();
if (isset($_POST['submit'])) {
    $connect = mysqli_connect('localhost', 'root', '');

    mysqli_select_db($connect, 'loginregister');

    $name = $_POST['user'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if($password != $password2){
        echo '<script type="text/javascript">jsFunction("passwords don\'t match");</script>';
        exit();
    }

    $s = " select * from users where username = '$name'";

    $result = mysqli_query($connect, $s);

    $num = mysqli_num_rows($result);

    if ($num == 1) {
        echo '<script type="text/javascript">jsFunction("username already exists");</script>';
    } else {
        $reg = " insert into users(username , password) values ('$name' , '$password')";
        mysqli_query($connect, $reg);
        echo '<script type="text/javascript">jsFunction("you have been registered successfully");</script>';

    }
}
?>
