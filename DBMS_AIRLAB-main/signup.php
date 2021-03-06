<?php
require_once "pdo.php";
session_start();
?>
<?php
if(isset($_POST['cancel'])){
	header('Location: index.php');
	die();
}
/*if(isset($_POST['confirm'])){
	if (strlen($_POST['votp']) < 1){
		$_SESSION['error'] = 'Invalid OTP entered. Please try again';
		header("Location: index.php");
		return;
	}
	if($_POST['votp'] == $_SESSION['rand']){
		$stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM login");
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row === false){
			$sno = 1;
		}
		else{
			$sno = $row['maxno'] + 1;
		}
		$stmt = $pdo->prepare("INSERT login (SNo, name, email, pass, cat) VALUES (:sno, :name, :email, :pass, :cat)");
		$stmt->execute(array(":sno" => $sno,
							 ":name" => $_SESSION['name'],
							 ":email" => $_SESSION['email'],
							 ":pass" => $_SESSION['pass'],
							 ":cat" => $_SESISON['cat']));
		$_SESISON['success'] = "Registration sucessful. Login to continue";
		header("Location: index.php");
		return;
	}
}*/
if(isset($_POST['email']) && isset($_POST['pass'])){
	if(isset($_POST['category'])){
		$cat = $_POST['category'];
		if($cat == "student"){
			$num = 1;
		}
		if($cat == "faculty"){
			$num = 2;
		}
		if($cat == "admin"){
			$num = 3;
		}
	}
	else{
		$_SESSION['error'] = 'Please select a category and proceed';
		header("Location: signup.php");
		die();
	}
	if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 || strlen($_POST['cpass']) < 1 || strlen($_POST['name']) < 1) {
        $_SESSION['error'] = 'Please fill all the fields';
        header("Location: signup.php");
        die();
    }
	if(strpos($_POST['email'],'@') === false){
		$_SESSION['error'] = 'Please enter a valid Email address containing @';
		header("Location: signup.php");
		die();
	}
	$stmt = $pdo->prepare("SELECT * FROM login where email = :xyz");
	$stmt->execute(array(":xyz" => $_POST['email']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row === false){
		if($_POST['pass'] != $_POST['cpass']){
			$_SESSION['error'] = "Password and confirm password fields do no match";
			header("Location: signup.php");
			return;
		}
		$stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM login");
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row === false){
			$sno = 1;
		}
		else{
			$sno = $row['maxno'] + 1;
		}
		$stmt = $pdo->prepare("INSERT login (SNo, name, email, pass, cat) VALUES (:sno, :name, :email, :pass, :cat)");
		$stmt->execute(array(":sno" => $sno,
							 ":name" => $_POST['name'],
							 ":email" => $_POST['email'],
							 ":pass" => $_POST['pass'],
							 ":cat" => $num));
		$_SESSION['success'] = "Registration sucessful. Login to continue";
		header("Location: index.php");
		return;
		/*else{
			$_SESSION['name'] = $_POST['name'];
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['pass'] = $_POST['pass'];
			$_SESSION['cat'] = $num;
			$_SESSION['rand'] = rand(100000,999999);
			$to = $_POST['otp'];
			$subject = "OTP number for registration in AIR LAB website";
			$txt = "Hello There! You have received the OTP number for the registration in AIR LAB website"."\n\n"."Your OTP is".$_SESSION['rand']."\n\n"."Regards"."\n"."AIR LAB webiste Team";
			$headers = "From: airlabdummy123@psgtech.ac.in";
			mail($to,$subject,$txt,$headers);
		}*/
	}
	else{
		$_SESSION['error'] = 'Email address already registered in the website.';
		header("Location: index.php");
		die();
	}
}
?>

<html>
<head>
	<title>Sign Up Page</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<center><div class="container" style="margin-top: 20px">
<?php
	if (isset($_SESSION['error']) ) {
	    echo '<div class="alert alert-primary" role="alert">'.$_SESSION['error']."</div>\n";
	    unset($_SESSION['error']);
	}
?>
<h1 style="margin-bottom: 80px; font-size: 40px">Sign up Form</h1>
<?php
echo '<form method="post" action="signup.php">
	<h3 style="font-size: 20px">Select the correct category</h3> 
	<input type="radio" class="btn-check" id="stud" name="category" value="student" autocomplete="off">
	<label class="btn btn-outline-primary" for="stud" style="margin-right:20px; margin-top: 20px; margin-bottom: 30px">Student</label>
	<input type="radio" class="btn-check" id="fac" name="category" value="faculty" autocomplete="off">
	<label class="btn btn-outline-primary" for="fac" style="margin-bottom: 30px; margin-top: 20px">Faculty</label>
	<input type="radio" class="btn-check" id="adm" name="category" value="admin" autocomplete="off">
	<label class="btn btn-outline-primary" for="adm" style="margin-top: 20px; margin-left:20px; margin-bottom: 30px">Admin</label>
	<br>
	<h3 style="margin-top: 20px; margin-bottom: 20px; font-size: 20px">Enter the required details</h3>
    <div class="form-floating col-5">
        	<input type="text" class="form-control" id="floatingName" name="name" placeholder="Name" autocomplete="off">
            <label for="floatingName">Name</label>         
    </div>
    <br>
    <div class="form-floating col-5">
        	<input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@gmail.com" autocomplete="off">
            <label for="floatingInput">Email address</label>         
    </div>
    <br>
    <div class="form-floating col-5">
        	<input type="Password" class="form-control" id="floatingNewPassword" name="pass" placeholder="New Password" autocomplete="off"> 
            <label for="floatingNewPassword">New Password</label>         
    </div>
    <br>
    <div class="form-floating col-5">
        	<input type="Password" class="form-control" id="floatingConfirmPassword" name="cpass" placeholder="Confirm Password" autocomplete="off">
            <label for="floatingConfirmPassword">Confirm Password</label>         
    </div>
    <br>
	<input style="margin: 10px" class="rounded-circle btn btn-outline-success" type="submit" name ="login" value="Register">
	<input class="rounded-circle btn btn-outline-danger" type="submit" name="cancel" value="Cancel">
</form>';
?>
</div>
</center>
</body>
</html>
