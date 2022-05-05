<html>

<head>
    <title> Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div id="color"></div>
<div id="color2"></div>

    <div class="container">
        <div class="row">
            <div class="col"></div>
            <h2> Login here</h2>
            <form action="<?php $PHP_SELF; ?>" method="post">
                <div class="form-object">
                    <label>Username</label>
                    <input type="text" name="user" required>
                </div>
                <div class="form-object">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <p id="message"></p>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>
            <a href="register.php">register </a>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>

<?php

use function PHPSTORM_META\map;

session_start();
if (isset($_POST['submit'])) {

$connect = mysqli_connect('localhost','root','');

mysqli_select_db($connect, 'loginregister');

$name = $_POST['user'];
$password = $_POST['password'];

$s = " select * from users where username = '$name' && password = '$password'";

$result = mysqli_query($connect, $s);

$num = mysqli_num_rows($result);

if($num==1){
    header('location:in.php');
} else{
    echo '<script type="text/javascript">jsFunction("wrong username or password");</script>';
}
}
?>