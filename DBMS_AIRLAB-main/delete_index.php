<?php
require_once "pdo.php";
session_start();
?>
<html>
<head>
	<title>Record to be deleted</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<center><div class="container" style="margin: 20px;padding-left: : 50px">
<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
?>
<?php
	if(isset($_POST['back'])){
		unset($_SESSION['table']);
		header("Location: main.php");
		return;
	}
	if(isset($_SESSION['table'])){
		if($_SESSION['table'] == "Moudetails"){
			$stmt = $pdo->query("SELECT * FROM MoU_Details");
			echo '<h1 style="margin-bottom: 80px">DELETE FROM MEMORANDUM OF UNDERSTANDING (MoU) TABLE</h1>';
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Outcome</th><th scope="col">MoU_Signal_with</th><th scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Outcome']));
			    echo("</td><td>");
			    echo(htmlentities($row['MoU_Signal_with']));
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.$row['SNo'].'">Delete</a>');
			    echo("</td></tr>\n");
			}
			echo '</table>';	
		}
		elseif($_SESSION['table'] == "private"){
			echo '<h1 style="margin-bottom: 80px">DELETE FROM PRIVATE CLOUD DETAILS TABLE</h1>';
			$stmt = $pdo->query("SELECT * FROM Private_Cloud");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Type</th><th scope="col">Capabilities</th><th scope="col">IaaS</th><th scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Cloud_Type']));
			    echo("</td><td>");
			    echo(htmlentities($row['Capabilities']));
			    echo("</td><td>");
			    echo(htmlentities($row['Iaas']));
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.$row['SNo'].'">Delete</a>');
			    echo("</td></tr>\n");
			}
			echo '</table>';
		}
		elseif($_SESSION['table'] == "funds"){
			echo '<h1 style="margin-bottom: 80px">DELETE FROM FUNDS RECEIVED TABLE</h1>';
			$stmt = $pdo->query("SELECT * FROM Funds_Generated");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Description</th><th scope="col">From_Year</th><th  scope="col">To_Year</th><th  scope="col">Grants_Received</th><th  scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Description']));
			    echo("</td><td>");
			    echo(htmlentities($row['From_Year']));
			    echo("</td><td>");
			    echo(htmlentities($row['To_Year']));
			    echo("</td><td>");
			    echo(htmlentities($row['Grants_Received']));
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.$row['SNo'].'">Delete</a>');
			    echo("</td></tr>\n");
			}
			echo '</table>';	
		}
		elseif($_SESSION['table'] == "datacenter"){
			echo '<h1 style="margin-bottom: 80px">DELETE FROM CLOUD DATA CENTER TABLE</h1>';
			$stmt = $pdo->query("SELECT * FROM Cloud_Data_Center");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Component_Name</th><th scope="col">Description</th><th scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Component_Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['Description']));
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.$row['SNo'].'">Delete</a>');
			    echo("</td></tr>\n");
			}
			echo '</table>';
		}
		elseif($_SESSION['table'] == "serverconfig"){
			echo '<h1 style="margin-bottom: 80px">DELETE FROM AIR LAB SERVER CONFIGURATION TABLE</h1>';
			$stmt = $pdo->query("SELECT * FROM AIR_Lab_Server");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Name</th><th scope="col">HD</th><th scope="col">DVD</th><th scope="col">RAM</th><th scope="col">Processor</th><th scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['HD']));
			    echo("</td><td>");
			    echo(htmlentities($row['DVD']));
			    echo("</td><td>");
			    echo(htmlentities($row['RAM']));
			    echo("</td><td>");
			    echo(htmlentities($row['Processor']));
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.$row['SNo'].'">Delete</a>');
			    echo("</td></tr>\n");
			}
			echo '</table>';
		}
		elseif($_SESSION['table'] == "security"){
			echo '<h1 style="margin-bottom: 80px">DELETE FROM DEVICES WITH LOGS AND USER COUNT TABLE</h1>'; 
			$stmt = $pdo->query("SELECT d.Device_ID, Device_Name, No_of_Users, Logs, F_Name as Feature_Name, f.F_ID FROM Devices d, Device_with_statistics s, Features f where d.Device_ID = s.Device_ID and s.F_ID = f.F_ID");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Device_Name</th><th scope="col">Feature_Name</th><th scope="col">No_of_Users</th><th scope="col">Logs</th><th scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Device_Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['Feature_Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['No_of_Users']));
			    echo("</td><td>");
			    echo(htmlentities($row['Logs']));
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.$row['Device_ID'].'&f_id='.$row['F_ID'].'">Delete</a>');
			    echo("</td></tr>\n");
			}
			echo '</table>';
			echo '<h1 style="margin-bottom: 20px; margin-top: 60px">DELETE FROM DEVICES WITH QUANTITY TABLE</h1>';
			$stmt = $pdo->query("SELECT d.Device_ID, Device_Name, Quantity FROM Devices d, Device_without_statistics s where s.Device_ID = d.Device_ID");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Device_Name</th><th scope="col">Quantity</th><th scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Device_Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['Quantity']));
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.$row['Device_ID'].'">Delete</a>');
			    echo("</td></tr>\n");
			}
			echo '</table>'; 
		}
		elseif($_SESSION['table'] == "research"){
			echo '<h1 style="margin-bottom: 80px">DELETE FROM RESEARCH TABLE</h1>';
			$stmt = $pdo->query("SELECT SNo, Title, Status, Faculty_Name FROM Faculty f, Research r where f.Faculty_ID = r.Faculty_ID");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Faculty_Name</th><th scope="col">Title</th><th scope="col">Status</th><th scope="col">Concepts</th><th scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Faculty_Name']));
			    echo("</td><td>");
			    echo(htmlentities($row['Title']));
			    echo("</td><td>");
			    echo(htmlentities($row['Status']));
			    echo("</td><td>");
			    $temp = $pdo->prepare("SELECT C_Field FROM Concepts c, Concepts_research cr where cr.SNo = :param and cr.C_No = c.C_No");
			    $temp->execute(array(
        						':param' => $row['SNo']));
			    while($rowtemp = $temp->fetch(PDO::FETCH_ASSOC)){
			    	echo htmlentities($rowtemp['C_Field']).'    ';
			    }
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.$row['SNo'].'">Delete</a>');
			    echo("</td></tr>\n");
			}
			echo '</table>';
			echo '<p>';
			$temp = $pdo->query("SELECT C_Field, C_Title FROM Concepts c");
			    while($rowtemp = $temp->fetch(PDO::FETCH_ASSOC)){
			    	echo  $rowtemp['C_Field'].' - '.$rowtemp['C_Title']."<br>";
			    }
			echo '</p>';
		}
		elseif($_SESSION['table'] == "project"){ //Needs to be changed
			echo '<h1 style="margin-bottom: 80px">DELETE FROM PROJECT DETAILS TABLE</h1>';
			$stmt = $pdo->query("SELECT * FROM Faculty f, batches b, company c WHERE f.Faculty_ID = b.Faculty_ID AND c.Company_ID = b.Company_ID");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Project Title</th><th scope="col">Roll number</th><th scope="col">Student Name</th><th scope="col">Faculty</th><th scope="col">Company</th><th scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Project_Title']));
			    echo("</td><td>");
			    $temp = $pdo->prepare("SELECT Roll_No FROM batch_students bs where bs.Batch_No = :param");
			    $temp->execute(array(
        						':param' => $row['Batch_No']));
			    echo('<table>'."\n");
			    while($rowtemp = $temp->fetch(PDO::FETCH_ASSOC)){
			    	echo '<tr><td>';
			    	echo htmlentities($rowtemp['Roll_No']);
			    	echo '</td><td>';
			    	echo('<a href="deleterec.php?rec_id='.$row['Batch_No'].'&rno='.$rowtemp['Roll_No'].'">Delete</a>');
			    	echo '</td></tr>';
			    }
			    echo ('</table>');
			    echo("</td><td>");
			    $temp = $pdo->prepare("SELECT Student_Name FROM student s, batch_students bs where bs.Batch_No = :param and bs.Roll_No = s.Roll_Number");
			    $temp->execute(array(
        						':param' => $row['Batch_No']));
			    echo('<table>'."\n");
			    while($rowtemp = $temp->fetch(PDO::FETCH_ASSOC)){
			    	echo '<tr><td>';
			    	echo htmlentities($rowtemp['Student_Name']);
			    	echo '</td></tr>';
			    }
			    echo '</table>';
			    echo("</td><td>");
			    echo(htmlentities($row['Faculty_Name'])); 
			    echo("</td><td>");
			    echo(htmlentities($row['Company_Name']));
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.$row['Batch_No'].'">Delete</a>');
			    echo("</td></tr>");
			}
			echo '</table>';
		}
		elseif($_SESSION['table'] == "faculty"){
			echo '<h1 style="margin-bottom: 80px">FACULTY TABLE</h1>';
			$stmt = $pdo->query("SELECT * FROM Faculty");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Faculty ID</th><th scope="col">Faculty Name</th><th scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Faculty_id']));
			    echo("</td><td>");
			    echo(htmlentities($row['Faculty_Name'])); 
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.htmlentities($row['Faculty_id']).'">Delete</a>');
			    echo("</td></tr>");
			}
			echo '</table>';
		}
		elseif($_SESSION['table'] == "student"){
			echo '<h1 style="margin-bottom: 80px">STUDENT TABLE</h1>';
			$stmt = $pdo->query("SELECT * FROM student");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Roll number</th><th scope="col">Student Name</th><th scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
			    echo "<tr><td>";
			    echo(htmlentities($row['Roll_Number']));
			    echo("</td><td>");
			    echo(htmlentities($row['Student_Name'])); 
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.htmlentities($row['Roll_Number']).'">Delete</a>');
			    echo("</td></tr>");
			}
			echo '</table>';
		}
		elseif($_SESSION['table'] == "concept"){
			echo '<h1 style="margin-bottom: 80px">CONCEPTS TABLE</h1>';
			$stmt = $pdo->query("SELECT * FROM concepts");
			echo('<table class="table table-bordered table-striped table-hover" border="2">'."\n");
			echo '<tr><th scope="col">Field</th><th scope="col">Title</th><th scope="col">Operation</th></tr>';
			while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			    echo "<tr><td>";
			    echo(htmlentities($row['C_Field']));
			    echo("</td><td>");
			    echo(htmlentities($row['C_Title']));
			    echo("</td><td>");
			    echo('<a href="deleterec.php?rec_id='.htmlentities($row['C_No']).'">Delete</a>'); 
			    echo("</td></tr>");
			}
			echo '</table>';
		}
	}
	else{
		$_SESSION['error'] = "Error occured. Please log in again";
		header("Location: main.php");
		return;
	}
?>
<br>
<form method="post">
<input class="btn btn-outline-Success" type="submit" name = "back" value="Back">
</div>
</center>
</body>
</html>
