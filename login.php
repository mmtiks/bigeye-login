<html>

<head>
    <title> Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://accounts.google.com/gsi/client" async defer on:load={googleLoaded}></script>
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
                    <label>Name/Mail</label>
                    <input type="text" name="user" id="username" required>
                </div>
                <div class="form-object">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <p id="message"></p>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>

                <div id="g_id_onload"
                    data-client_id="243917720407-ehou79d0bqm0853t2fc0d5fo0fqc709f.apps.googleusercontent.com"
                    data-callback="handleCredentialResponse">
                </div>
                <div class="g_id_signin" data-on-success="onSignIn" data-type="standard"></div>

            </form>
            <a href="register.php">register </a>
        </div>
    </div>
    <script src="script.js"></script>
</body>
<script>
    import { onMount } from 'svelte';
    let googleReady = false;
    let mounted = false;

    onMount(() => {
        mounted = true;
        if (googleReady) {
            displaySignInButton()
        }
    });

    function googleLoaded() {
        googleReady = true;
        if (mounted) {
            displaySignInButton()
        }
    }

    function displaySignInButton() {
        google.accounts.id.initialize({
            client_id: "x.apps.googleusercontent.com",
            callback: handleCredentialResponse
        });
        google.accounts.id.renderButton(
            document.getElementById("buttonDiv"),
            { theme: "outline", size: "large" }  // customization attributes
        );
        google.accounts.id.prompt(); // also display the One Tap dialog
    }
        google.accounts.id.prompt()}
    function onSignIn(googleUser){
        console.log('User is' + JSON.stringify(googleUser.getBasicProfile));
    }

</html>

<?php

use function PHPSTORM_META\map;

session_start();
if (isset($_POST['submit'])) {

$connect = mysqli_connect('localhost','root','');

mysqli_select_db($connect, 'loginregister');

$name = $_POST['user'];
$password = $_POST['password'];

$s = " select * from users where (name = '$name' || email = '$name') && password = '$password'";

$result = mysqli_query($connect, $s);

$num = mysqli_num_rows($result);

if($num==1){
    header('location:in.php');
} else{
    echo '<script type="text/javascript">jsFunction("wrong username/email or password");</script>';
}
}
?>