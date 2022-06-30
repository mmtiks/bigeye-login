<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
?>
<html style="overflow:hidden">

<head>
    <title> Home Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a href="logout.php" style="position:absolute; top:0; left:0">logout</a>
    <iframe src="https://gifer.com/embed/3HeL" width=1920 height=1080 frameBorder="0" allowFullScreen></iframe>
</body>

</html>