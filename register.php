<?php
session_start();
?>
<html>

<head>
    <title> Register</title>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo time(); ?>" />
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
                    <input type="text" name="user" id="username" required>
                </div>
                <div class="form-object">

                    <label>Email Ad</label>
                    <input type="text" placeholder="example@mail.com" name="mail" id="mail" required>
                </div>
                <div class="form-object">
                    <label>Password</label>
                    <input type="password" placeholder="6+ characters, 1+ number" name="password" required>
                </div>
                <div class="form-object">
                    <label>Password</label>
                    <input type="password" placeholder='repeat password' name="password2" required>
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
if (isset($_POST['submit'])) {
    include("db.php");

    $mail = $_POST['mail'];
    $username = $_POST['user'];
    $passwordd = $_POST['password'];
    $password2 = $_POST['password2'];
    // https://stackoverflow.com/questions/13447539/php-preg-match-with-email-validation-issue
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

    if (!(preg_match($pattern, $mail))) {
        echo '<script type="text/javascript">jsFunction("invalid e-mail aadress");</script>';
        exit();
    } else if ($passwordd != $password2) {
        echo '<script type="text/javascript">jsFunction("passwords don\'t match");</script>';
        exit();
    } else if (strlen($passwordd) < 6) {
        echo '<script type="text/javascript">jsFunction("password should have at least 6 characters");</script>';
        exit();
    } else if (!(preg_match('~[0-9]+~', $passwordd))) {
        echo '<script type="text/javascript">jsFunction("password should have at least 1 number");</script>';
        exit();
    }

    $stmt = $pdo->prepare('SELECT * FROM users WHERE name = :username OR email = :mail');
    $stmt->execute(array('username' => $username, 'mail' => $mail));
    $posts = $stmt->fetchAll();

    $regstmt = $pdo->prepare('INSERT INTO users(email, name, password) VALUES(?,?,?)');

    if (count($posts) == 1) {
        echo '<script type="text/javascript">jsFunction("username or email is already in use");</script>';
    } else {
        $hash = password_hash($passwordd, PASSWORD_DEFAULT);
        $regstmt->execute(array($mail, $username, $hash));
        echo '<script type="text/javascript">jsFunction("you have been registered successfully");</script>';
    }
}
?>