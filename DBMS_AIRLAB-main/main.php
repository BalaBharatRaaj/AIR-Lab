<?php
require_once "pdo.php";
session_start();
?>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<title>Login Page</title>
	<title>Main Page</title>
</head>
<body>
<?php 
if(isset($_POST['logout'])){
	header("Location: logout.php");
	return;
}

if(isset($_POST['submit'])){
	if(isset($_POST['table']) || isset($_POST['operation'])){
		if(!isset($_POST['table'])){
			$_SESSION['error'] = "Please select a table";
			header("Location: main.php?");
			return;
		}
		elseif(!isset($_POST['operation'])){
			$_SESSION['error'] = "Please select an operation";
			header("Location: main.php?");
			return;
		}

		if($_POST['table'] == "project"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "research"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "Moudetails"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "funds"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "private"){
			$_SESSION['table'] =$_POST['table'];
		}
		elseif($_POST['table'] == "datacenter"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "security"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "serverconfig"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "faculty"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "student"){
			$_SESSION['table'] = $_POST['table'];
		}
		elseif($_POST['table'] == "concept"){
			$_SESSION['table'] = $_POST['table'];
		}
		else{
			$_SESSION['error'] = "Please select a table";
			header("Location: main.php");
			return;
		}

		if($_POST['operation'] == "insert"){
			$_SESSION['operation'] = $_POST['operation'];
			header("Location: insert.php");
			return;
		}
		elseif($_POST['operation'] == "delete"){
			$_SESSION['operation'] = $_POST['operation'];
			header("Location: delete_index.php");
			return;
		}
		elseif($_POST['operation'] == "update"){
			$_SESSION['operation'] = $_POST['operation'];
			header("Location: edit_index.php");
			return;
		}
		elseif($_POST['operation'] == "read"){
			$_SESSION['operation'] = $_POST['operation'];
			header("Location: read.php");
			return;
		}
		else{
			$_SESSION['error'] = "Please select an operation";
			header("Location: main.php?");
			return;
		}
	}
	else{
		$_SESSION['error'] = "Please select a table or category";
		header("Location: main.php?");
		return;
	}
}


if(!(isset($_SESSION['name']) && isset($_SESSION['user_cat']))){ 
		$_SESSION['error'] = "Required parameters not available. Please Log in again";
		header("Location: index.php");
		return;
}
?>

<center><div class="container" style="margin-top: 20px">
<?php
if ( isset($_SESSION['success']) ) {
    echo '<div class="alert alert-success" role="alert">'.$_SESSION['success']."</div>\n";
    unset($_SESSION['success']);
}
if ( isset($_SESSION['error']) ) {
    echo '<div class="alert alert-primary" role="alert">'.$_SESSION['error']."</div>\n";
    unset($_SESSION['error']);
}
?>
<?php
echo '<h1 style="margin-bottom: 80px">WELCOME TO AIR LAB WEBSITE'." - ".$_SESSION['name']." ".'</h1>';
?>
<div>
	<h3 style="margin-bottom: 20px">SELECT AN OPERATION</h3>
</div>
<?php
if($_SESSION['user_cat'] == 3){
	echo '<form method="POST" action="main.php">
	<div>
		<input type="radio" class="btn-check" id="ins" name="operation" value="insert" autocomplete="off">
		<label class="btn btn-outline-Info" for="ins" style="margin: 10px">Insert</label>
		<input type="radio" class="btn-check" id="upd" name="operation" value="update" autocomplete="off">
		<label class="btn btn-outline-Info" for="upd">Update</label>
		<input type="radio" class="btn-check" id="del" name="operation" value="delete" autocomplete="off">
		<label class="btn btn-outline-Info" for="del" style="margin: 10px">Delete</label>
		<input type="radio" class="btn-check" id="rea" name="operation" value="read" autocomplete="off">
		<label class="btn btn-outline-Info" for="rea">Display</label><br>
	</div>
	<div>
		<h3 style="margin-top: 40px">TABLES AVAILABLE</h3>
	</div>
	<div>
		<input type="radio"  class="btn-check" id="proj" name="table" value="project" autocomplete="off">
		<label class="btn btn-outline-primary" for="proj" style="margin: 10px">Project Table</label>
		<input type="radio"  class="btn-check" id="phd" name="table" value="research" autocomplete="off">
		<label class="btn btn-outline-primary" for="phd">Research Table</label><br>
		<input type="radio"  class="btn-check" id="Mou" name="table" value="Moudetails" autocomplete="off">
		<label class="btn btn-outline-primary" for="Mou" style="margin: 10px">Memorandum of Understanding Table</label>
		<input type="radio"  class="btn-check" id="ser" name="table" value="serverconfig" autocomplete="off">
		<label class="btn btn-outline-primary" for="ser" style="margin: 10px">AIR LAB Server Configuration Table</label><br>
		<input type="radio"  class="btn-check" id="fund" name="table" value="funds" autocomplete="off">
		<label class="btn btn-outline-primary" for="fund" style="margin: 10px">Funds Received Table</label>
		<input type="radio"  class="btn-check" id="priv" name="table" value="private" autocomplete="off">
		<label class="btn btn-outline-primary" for="priv">Private Cloud Details Table</label>
		<input type="radio"  class="btn-check" id="data" name="table" value="datacenter" autocomplete="off">
		<label class="btn btn-outline-primary" for="data" style="margin: 10px">Cloud Data Center Table</label>
		<input type="radio"  class="btn-check" id="sec" name="table" value="security" autocomplete="off">
		<label class="btn btn-outline-primary" for="sec">Security Infrastructure Table</label><br>
	</div>
	<div>
		<h3 style="margin-top: 40px">OTHER TABLES</h3>
	</div>
	<div>
		<input type="radio"  class="btn-check" id="fac" name="table" value="faculty" autocomplete="off">
		<label class="btn btn-outline-dark" for="fac" style="margin: 10px">Faculty Table</label>
		<input type="radio"  class="btn-check" id="stu" name="table" value="student" autocomplete="off">
		<label class="btn btn-outline-dark" for="stu">Student Table</label>
		<input type="radio"  class="btn-check" id="con" name="table" value="concept" autocomplete="off">
		<label class="btn btn-outline-dark" for="con" style="margin: 10px">Concepts Table</label>
	</div>';
}
elseif ($_SESSION['user_cat'] == 2){
	echo '<form method="POST" action="main.php">
	<div>
		<input type="radio"  class="btn-check" id="upd" name="operation" value="update" autocomplete="off">
		<label class="btn btn-outline-Info"for="upd" style="margin-right: 10px">Update</label>
		<input type="radio"  class="btn-check" id="rea" name="operation" value="read" autocomplete="off">
		<label class="btn btn-outline-Info" for="rea">Display</label>
	</div>
	<div>
		<h3 style="margin-top: 40px">TABLES AVAILABLE</h3>
	</div>
	<div>
		<input type="radio"  class="btn-check" id="proj" name="table" value="project" autocomplete="off">
		<label class="btn btn-outline-primary" for="proj" style="margin: 10px">Project Table</label>
		<input type="radio"  class="btn-check" id="phd" name="table" value="research" autocomplete="off">
		<label class="btn btn-outline-primary" for="phd">Research Table</label><br>
		<input type="radio"  class="btn-check" id="Mou" name="table" value="Moudetails" autocomplete="off">
		<label class="btn btn-outline-primary" for="Mou" style="margin: 10px">Memorandum of Understanding Table</label>
		<input type="radio"  class="btn-check" id="ser" name="table" value="serverconfig" autocomplete="off">
		<label class="btn btn-outline-primary" for="ser" style="margin: 10px">AIR LAB Server Configuration Table</label><br>
		<input type="radio"  class="btn-check" id="fund" name="table" value="funds" autocomplete="off">
		<label class="btn btn-outline-primary" for="fund" style="margin: 10px">Funds Received Table</label>
		<input type="radio"  class="btn-check" id="priv" name="table" value="private" autocomplete="off">
		<label class="btn btn-outline-primary" for="priv">Private Cloud Details Table</label>
		<input type="radio"  class="btn-check" id="data" name="table" value="datacenter" autocomplete="off">
		<label class="btn btn-outline-primary" for="data" style="margin: 10px">Cloud Data Center Table</label>
		<input type="radio"  class="btn-check" id="sec" name="table" value="security" autocomplete="off">
		<label class="btn btn-outline-primary" for="sec">Security Infrastructure Table</label><br>
	</div>
	<div>
		<h3 style="margin-top: 40px">OTHER TABLES</h3>
	</div>
	<div>
		<input type="radio"  class="btn-check" id="fac" name="table" value="faculty" autocomplete="off">
		<label class="btn btn-outline-dark" for="fac" style="margin: 10px">Faculty Table</label>
		<input type="radio"  class="btn-check" id="stu" name="table" value="student" autocomplete="off">
		<label class="btn btn-outline-dark" for="stu">Student Table</label>
		<input type="radio"  class="btn-check" id="con" name="table" value="concept" autocomplete="off">
		<label class="btn btn-outline-dark" for="con" style="margin: 10px">Concepts Table</label>
	</div>';
}
elseif($_SESSION['user_cat'] == 1){
	echo '<form method="POST" action="main.php">
	<div>
		<input type="radio" class="btn-check" id="rea" name="operation" value="read" autocomplete="off">
		<label class="btn btn-outline-Info" for="rea">Display</label>
	</div>
	<div>
		<h3 style="margin-top: 40px">TABLES AVAILABLE</h3>
	</div>
	<div>
		<input type="radio"  class="btn-check" id="proj" name="table" value="project" autocomplete="off">
		<label class="btn btn-outline-primary" for="proj" style="margin: 10px">Project Table</label>
		<input type="radio"  class="btn-check" id="phd" name="table" value="research" autocomplete="off">
		<label class="btn btn-outline-primary" for="phd">Research Table</label><br>
		<input type="radio"  class="btn-check" id="Mou" name="table" value="Moudetails" autocomplete="off">
		<label class="btn btn-outline-primary" for="Mou" style="margin: 10px">Memorandum of Understanding Table</label>
		<input type="radio"  class="btn-check" id="ser" name="table" value="serverconfig" autocomplete="off">
		<label class="btn btn-outline-primary" for="ser" style="margin: 10px">AIR LAB Server Configuration Table</label><br>
		<input type="radio"  class="btn-check" id="fund" name="table" value="funds" autocomplete="off">
		<label class="btn btn-outline-primary" for="fund" style="margin: 10px">Funds Received Table</label>
		<input type="radio"  class="btn-check" id="priv" name="table" value="private" autocomplete="off">
		<label class="btn btn-outline-primary" for="priv">Private Cloud Details Table</label>
		<input type="radio"  class="btn-check" id="data" name="table" value="datacenter" autocomplete="off">
		<label class="btn btn-outline-primary" for="data" style="margin: 10px">Cloud Data Center Table</label>
		<input type="radio"  class="btn-check" id="sec" name="table" value="security" autocomplete="off">
		<label class="btn btn-outline-primary" for="sec">Security Infrastructure Table</label><br>
	</div>
	<div>
		<h3 style="margin-top: 40px">OTHER TABLES</h3>
	</div>
	<div>
		<input type="radio"  class="btn-check" id="fac" name="table" value="faculty" autocomplete="off">
		<label class="btn btn-outline-dark" for="fac" style="margin: 10px">Faculty Table</label>
		<input type="radio"  class="btn-check" id="stu" name="table" value="student" autocomplete="off">
		<label class="btn btn-outline-dark" for="stu">Student Table</label>
		<input type="radio"  class="btn-check" id="con" name="table" value="concept" autocomplete="off">
		<label class="btn btn-outline-dark" for="con" style="margin: 10px">Concepts Table</label>
	</div>';
}
?>
	<p style="margin-top: 40px">
		<input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
		<input class="btn btn-outline-Danger" type="submit" name = "logout" value="Log Out">
	</p>
</form>
</div>
</center>
</body>
</html>
