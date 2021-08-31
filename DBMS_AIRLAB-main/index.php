<?php
require_once "pdo.php";
session_start();
unset($_SESSION['user_cat']);
unset($_SESSION['name']);
unset($_SESSION['table']);
unset($_SESSION['device_table']);
?>
<html>
<head>
	<title>AIR LAB website</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head><body><center><div class="container" style="margin-top: 20px">
<h1 style="font-size: 40px; margin-bottom: 80px">WELCOME TO PSG COLLEGE OF TECHNOLOGY AIR LAB</h1>
<?php
if ( isset($_SESSION['error']) ) {
    echo '<div class="alert alert-primary" role="alert">'.$_SESSION['error']."</div>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<div class="alert alert-success" role="alert">'.$_SESSION['success']."</div>\n";
    unset($_SESSION['success']);
}
?>
</table>
<a href="login.php" style="font-size: 20px">Log in</a><br><br>
<p><h4>Not an existing user?</h4><a href="signup.php">Sign Up here</a></p>
</body>
</div>
</center>
</html>

