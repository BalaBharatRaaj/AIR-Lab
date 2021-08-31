  
<?php
require_once "pdo.php";
session_start();?>
<html>
<head>
    <title>Record to be updated</title>
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
if(isset($_POST['back'])){
    header("Location: main.php");
    unset($_SESSION['device']);
    unset($_SESSION['table']);
    return;
}
if(isset($_SESSION['table']) && isset($_GET['rec_id'])){
	if($_SESSION['table'] == "Moudetails"){
		echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS - MEMORANDUM OF UNDERSTANDING (MoU) TABLE</h1>';
		if(isset($_POST['outcome']) && isset($_POST['MoUSignal'])){
            if (strlen($_POST['outcome']) < 1 || strlen($_POST['MoUSignal']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: update.php?rec_id=".htmlentities($_POST['SNo'])."");
                return;
            }
            $sql = "UPDATE mou_details SET Outcome = :out, MoU_Signal_with = :mousig WHERE SNo = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['SNo'],
                ':out' => $_POST['outcome'],
                ':mousig' => $_POST['MoUSignal']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
		$stmt = $pdo->prepare("SELECT * FROM mou_details where SNo = :xyz");
		$stmt->execute(array(":xyz" => $_GET['rec_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row === false ) {
		    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
		    header( 'Location: main.php' ) ;
		    return;
		}
		echo '<form method="post">
        <p style="text-align: left">Outcome:
        <input class="form-control" type="text" name="outcome" value = "'.htmlentities($row['Outcome']).'" autocomplete="off"></p>
        <p style="text-align: left">MoU_Signal_with:
        <input class="form-control" type="text" name="MoUSignal" value = "'.htmlentities($row['MoU_Signal_with']).'"></p>
        <input class="btn btn-outline-Info" type="hidden" name="SNo" value="'.htmlentities($row['SNo']).'">
        <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
                <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
	}
	elseif($_SESSION['table'] == "private"){
        echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS - PRIVATE CLOUD DETAILS TABLE</h1>';
        if(isset($_POST['cloud']) && isset($_POST['capab']) && isset($_POST['Iaas'])){
            if (strlen($_POST['cloud']) < 1 || strlen($_POST['capab']) < 1 || strlen($_POST['Iaas']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: update.php?rec_id=".htmlentities($_POST['SNo'])."");
                return;
            }
            $sql = "UPDATE private_cloud SET Cloud_Type = :cloud, Capabilities = :capab, Iaas = :iaas WHERE SNo = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['SNo'],
                ':cloud' => $_POST['cloud'],
                ':capab' => $_POST['capab'],
                ':iaas' => $_POST['Iaas']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        $stmt = $pdo->prepare("SELECT * FROM private_cloud where SNo = :xyz");
		$stmt->execute(array(":xyz" => $_GET['rec_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row === false ) {
		    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
		    header( 'Location: main.php' ) ;
		    return;
		}
		echo '<form method="post">
        <p style="text-align: left">Cloud_Type:
        <input class="form-control" type="text" name="cloud" value="'.htmlentities($row['Cloud_Type']).'"></p>
        <p style="text-align: left">Capabilities:
        <input class="form-control" type="text" name="capab" value="'.htmlentities($row['Capabilities']).'"></p>
        <p style="text-align: left">IaaS:
        <input class="form-control" type="text" name="Iaas" value="'.htmlentities($row['Iaas']).'"></p>
        <input class="form-control" type="hidden" name="SNo" value="'.htmlentities($row['SNo']).'">
        <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
                <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
    }
    elseif($_SESSION['table'] == "funds"){
    	echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS - FUNDS RECEIVED TABLE</h1>';
    	if(isset($_POST['desc']) && isset($_POST['from']) && isset($_POST['to']) && isset($_POST['grants'])){
            if (strlen($_POST['desc']) < 1 || strlen($_POST['from']) < 1 || strlen($_POST['to']) < 1 ||strlen($_POST['grants']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: update.php?rec_id=".htmlentities($_POST['SNo'])."");
                return;
            }
            if(!(is_numeric($_POST['from']) && is_numeric($_POST['to']) && is_numeric($_POST['grants']))){
                $_SESSION['error'] = 'Enter numeric values in From_year, To_year and Grants_Received fields';
                header("Location: update.php?rec_id=".htmlentities($_POST['SNo'])."");
                return;
            }
            $sql = "UPDATE funds_generated SET Description = :descr, From_year = :fromy, To_year = :toy, Grants_Received = :gra WHERE SNo = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ":val" => $_POST['SNo'],
                ":descr" => $_POST['desc'],
                ":fromy" => $_POST['from'],
                ":toy" => $_POST['to'],
                ":gra" => $_POST['grants']." Lakhs"));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        $stmt = $pdo->prepare("SELECT * FROM funds_generated where SNo = :xyz");
		$stmt->execute(array(":xyz" => $_GET['rec_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row === false ) {
		    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
		    header( 'Location: main.php' ) ;
		    return;
		}
		$match = preg_replace('/[^0-9\.]/', '', $row['Grants_Received']);
		echo '<form method="post">
        <p style="text-align: left">Description:
        <input class="form-control" type="text" name="desc" value="'.htmlentities($row['Description']).'" autocomplete="off"></p>
        <p style="text-align: left">From_Year:
        <input class="form-control" type="text" name="from" value="'.htmlentities($row['From_Year']).'" autocomplete="off"></p>
        <p style="text-align: left">To_Year:
        <input class="form-control" type="text" name="to" value="'.htmlentities($row['To_Year']).'" autocomplete="off"></p>
        <p style="text-align: left">Grants_Received (Enter only the numeric value in Lakhs):
        <input class="form-control" type="text" name="grants" value="'.$match.'" autocomplete="off"></p>
        <input class="btn btn-outline-Info" type="hidden" name="SNo" value="'.htmlentities($row['SNo']).'">
       <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
                <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
    }
    elseif($_SESSION['table'] == "datacenter"){
    	echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS - CLOUD DATA CENTER TABLE</h1>';
    	if(isset($_POST['comp']) && isset($_POST['desc'])){
            if (strlen($_POST['comp']) < 1 || strlen($_POST['desc']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: update.php?rec_id=".htmlentities($_POST['SNo'])."");
                return;
            }
            $sql = "UPDATE cloud_data_center SET Component_Name = :comp, Description = :descr WHERE SNo = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['SNo'],
                ':comp' => $_POST['comp'],
                ':descr' => $_POST['desc']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        $stmt = $pdo->prepare("SELECT * FROM cloud_data_center where SNo = :xyz");
		$stmt->execute(array(":xyz" => $_GET['rec_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row === false ) {
		    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
		    header( 'Location: main.php' ) ;
		    return;
		}
		echo '<form method="post">
        <p style="text-align: left">Component_Name:
        <input class="form-control" type="text" name="comp" value="'.htmlentities($row['Component_Name']).'" autocomplete="off"></p>
        <p style="text-align: left">Description:
        <input class="form-control" type="text" name="desc" value="'.htmlentities($row['Description']).'" autocomplete="off"></p>
        <input class="form-control" type="hidden" name="SNo" value="'.htmlentities($row['SNo']).'">
        <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
                <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
    }
    elseif($_SESSION['table'] == "serverconfig"){
    	echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS - AIR LAB SERVER CONFIGURATION TABLE</h1>';
        if(isset($_POST['hd']) && isset($_POST['dvd']) && isset($_POST['ram']) && isset($_POST['processor']) && isset($_POST['name'])){
            if (strlen($_POST['ram']) < 1 || strlen($_POST['processor']) < 1 || strlen($_POST['name']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: update.php?rec_id=".htmlentities($_POST['SNo'])."");
                return;
            }
            $sql = "UPDATE air_lab_server SET HD = :hd, DVD = :dvd, RAM = :ram, Processor = :pro, Name = :name WHERE SNo = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['SNo'],
                ':hd' => $_POST['hd'],
                ':dvd' => $_POST['dvd'],
                ':ram' => $_POST['ram'],
                ':pro' => $_POST['processor'],
                ':name' => $_POST['name']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        $stmt = $pdo->prepare("SELECT * FROM air_lab_server where SNo = :xyz");
		$stmt->execute(array(":xyz" => $_GET['rec_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row === false ) {
		    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
		    header( 'Location: main.php' ) ;
		    return;
		}
		echo '<form method="post">
        <p style="text-align: left">Name:
        <input class="form-control" type="text" name="name" value="'.htmlentities($row['Name']).'" autocomplete="off"></p>
        <p style="text-align: left">HD:
        <input class="form-control" type="text" name="hd" value="'.htmlentities($row['HD']).'" autocomplete="off"></p>
        <p style="text-align: left">DVD:
        <input class="form-control" type="text" name="dvd" value="'.htmlentities($row['DVD']).'" autocomplete="off"></p>
        <p style="text-align: left">RAM:
        <input class="form-control" type="text" name="ram" value="'.htmlentities($row['RAM']).'" autocomplete="off"></p>
        <p style="text-align: left">Processor:
        <input class="form-control" type="text" name="processor" value="'.htmlentities($row['Processor']).'" autocomplete="off"></p>
        <input class="btn btn-outline-Info" type="hidden" name="SNo" value="'.htmlentities($row['SNo']).'" autocomplete="off">
       <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
                <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
    }
    elseif($_SESSION['table'] == "security"){
    	if(isset($_POST['device']) && isset($_POST['feature']) && isset($_POST['users']) && isset($_POST['logs'])){
            if (strlen($_POST['device']) < 1 || strlen($_POST['users']) < 1 || strlen($_POST['logs']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: update.php?rec_id=".htmlentities($_POST['DevNo'])."&f_id=".htmlentities($_POST['FNo']));
                return;
            }
            if(!(is_numeric($_POST['users']) && is_numeric($_POST['logs']))){
                $_SESSION['error'] = 'Enter numeric values in No. of Users and Logs fields';
                 header("Location: update.php?rec_id=".htmlentities($_POST['DevNo'])."&f_id=".htmlentities($_POST['FNo']));
                return;
            }
            $sql = "UPDATE devices SET Device_Name = :dname WHERE Device_ID = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['DevNo'],
                ':dname' => $_POST['device']));
            $sql = "UPDATE features SET F_Name = :fname WHERE F_ID = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['FNo'],
                ':fname' => $_POST['feature']));
            $sql = "UPDATE device_with_statistics SET No_of_Users = :use, Logs = :log WHERE Device_ID = :val AND F_ID = :fno";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['DevNo'],
                ':use' => $_POST['users'],
            	':log' => $_POST['logs'],
            	':fno' => $_POST['FNo']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        elseif(isset($_POST['device']) && isset($_POST['quantity'])){
            if (strlen($_POST['device']) < 1 || strlen($_POST['quantity']) < 1) {
                $_SESSION['error'] = 'Missing data';
                 header("Location: update.php?rec_id=".htmlentities($_POST['DevNo']));
                return;
            }
            if(!(is_numeric($_POST['quantity']))){
                $_SESSION['error'] = 'Enter numeric values in quantity field';
                header("Location: update.php");
                return;
            }
            $sql = "UPDATE devices SET Device_Name = :dname WHERE Device_ID = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['DevNo'],
                ':dname' => $_POST['device']));
            $sql = "UPDATE device_without_statistics SET Quantity = :quan WHERE Device_ID = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $_POST['DevNo'],
                ':quan' => $_POST['quantity']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }

        if(isset($_GET['f_id'])){
            echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS - DEVICES WITH LOGS AND USER COUNT TABLE</h1>';
        	$stmt = $pdo->prepare("SELECT * FROM device_with_statistics, Devices d, Features f where d.Device_ID = :xyz AND f.F_ID = :val");
			$stmt->execute(array(
				":xyz" => $_GET['rec_id'],
				":val" => $_GET['f_id']));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ( $row === false ) {
			    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
			    header( 'Location: index.php' ) ;
			    return;
			}
        	echo '<form method="post">
                <p style="text-align: left">Device Name:
                <input class="form-control" type="text" name="device" value="'.htmlentities($row['Device_Name']).'" autocomplete="off"></p>
                <p style="text-align: left">Feature Name:
                <input class="form-control" type="text" name="feature" value="'.htmlentities($row['F_Name']).'" autocomplete="off"></p>
                <p style="text-align: left">Number of Users (in numbers):
                <input class="form-control" type="text" name="users" value="'.htmlentities($row['No_of_Users']).'" autocomplete="off"></p>
                <p style="text-align: left">Logs (in numbers):
                <input class="form-control" type="text" name="logs" value="'.htmlentities($row['Logs']).'" autocomplete="off"></p>
                <input class="form-control" type="hidden" name="FNo" value="'.htmlentities($row['F_ID']).'" autocomplete="off">
                <input class="form-control" type="hidden" name="DevNo" value="'.htmlentities($row['Device_ID']).'" autocomplete="off">
                <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
                <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
                </form>';
        }
        else{
            echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS - DEVICES WITH QUANTITY TABLE</h1>';
        	$stmt = $pdo->prepare("SELECT * FROM device_without_statistics dws, Devices d where d.Device_ID = :xyz AND d.Device_ID = dws.Device_ID");
			$stmt->execute(array(":xyz" => $_GET['rec_id']));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ( $row === false ) {
			    $_SESSION['error'] = 'The ID for the record to be updated is missing.';
			    header( 'Location: index.php' ) ;
			    return;
			}
        	echo '<form method="post">
                <p style="text-align: left">Device Name:
                <input class="form-control" type="text" name="device" value="'.htmlentities($row['Device_Name']).'" autocomplete="off"></p>
                <p style="text-align: left">Quantity:
                <input class="form-control" type="text" name="quantity" value="'.htmlentities($row['Quantity']).'" autocomplete="off"></p>
                <input class="btn btn-outline-Info" type="hidden" name="DevNo" value="'.htmlentities($row['Device_ID']).'" autocomplete="off">
                <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
                <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
                </form>'; 
        }
    }
    elseif($_SESSION['table'] == "research"){
    	echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS FOR THE TABLE - RESEARCH</h1>';
        if(isset($_POST['title']) && isset($_POST['status']) && isset($_POST['concepts']) && isset($_POST['faculty'])){
            if(strlen($_POST['title']) < 1 || strlen($_POST['status']) < 1 || strlen($_POST['concepts']) < 1 || strlen($_POST['faculty']) < 1){
                $_SESSION['error'] = 'Fill all the fields';
                header('Location: update.php?rec_id='.htmlentities($_POST['SNo'])) ;
                return;
            }
            $stmt = $pdo->prepare("SELECT Faculty_id FROM Faculty where Faculty_Name = :xyz");
            $stmt->execute(array(":xyz" => $_POST['faculty']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $_SESSION['error'] = 'Faculty Name not found in the table';
                header('Location: update.php?rec_id='.htmlentities($_POST['SNo']));
                return;
            }
            else{
                $fno = $row['Faculty_id'];
            }
            $str = str_replace('  ',' ',$_POST['concepts']);
            $str_arr = explode(" ", $str);
            //print_r($str_arr);
            //print($str);
            //die();
            for($i=0; $i<count($str_arr); $i++){
                for($j=$i+1; $j<count($str_arr); $j++){
                    if(($str_arr[$i] == $str_arr[$j])){
                        $_SESSION['error'] = 'Repeated concepts found in the entry';
                        header('Location: update.php?rec_id='.htmlentities($_POST['SNo']));
                        return;
                    }
                }
            }
            for($i=0; $i<count($str_arr); $i++){
                $stmt = $pdo->prepare("SELECT * FROM concepts where C_Field = :xyz");
                $stmt->execute(array(":xyz" => $str_arr[$i]));
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row === false){
                    $_SESSION['error'] = 'Concept '.$str_arr[$i].' not found in the concepts table';
                    //print_r($str_arr);
                    header('Location: update.php?rec_id='.htmlentities($_POST['SNo']));
                    die();
                    return;break;
                }
                else{
                    continue;
                }
            }
            $stmt = $pdo->prepare("DELETE FROM concepts_research where SNo = :val");
            $stmt->execute(array(":val" => $_POST['SNo']));
            $sql = "UPDATE research SET Title = :title, status = :stat, Faculty_ID = :fac WHERE SNo = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':val' => $_POST['SNo'],
            ':title' => $_POST['title'],
            ':stat' => $_POST['status'],
            ':fac' => $fno));
            for($i=0; $i<count($str_arr); $i++){
                $sql = "INSERT INTO concepts_research (SNo, C_No) VALUES (:val, :cno)";
                $stmt = $pdo->prepare($sql);
                $stmt1 = $pdo->prepare("SELECT C_No FROM concepts where C_Field = :xyz");
                $stmt1->execute(array(":xyz" => $str_arr[$i]));
                $rowtemp = $stmt1->fetch(PDO::FETCH_ASSOC);
                $stmt->execute(array(
                ':val' => $_POST['SNo'],
                ':cno' => $rowtemp['C_No']));
            }
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        $stmt = $pdo->prepare("SELECT SNo, Title, Status, Faculty_Name FROM Faculty f, Research r where f.Faculty_ID = r.Faculty_ID AND SNo = :val");
        $stmt->execute(array(":val" => $_GET['rec_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ( $row === false ) {
            $_SESSION['error'] = 'The ID for the record to be updated is missing.';
            header( 'Location: edit_index.php' ) ;
            return;
        }
        $temp = $pdo->prepare("SELECT C_Field FROM Concepts c, Concepts_research cr where cr.SNo =:param and cr.C_No = c.C_No");
        $temp->execute(array(':param' => $_GET['rec_id']));
        $i = 0;
        $str_disarr = [];
        while($rowtemp = $temp->fetch(PDO::FETCH_ASSOC)){
            $str_disarr[$i] = $rowtemp['C_Field'];
            $i = $i + 1;
        }
        $strdisp = implode(" ",$str_disarr);
        echo '<form method="post">
        <p style="text-align: left">Faculty Name:
        <input class="form-control" type="text" name="faculty" value="'.htmlentities($row['Faculty_Name']).'" autocomplete="off"></p>
        <p style="text-align: left">Title:
        <input class="form-control" type="text" name="title" value="'.htmlentities($row['Title']).'" autocomplete="off"></p>
        <p style="text-align: left">Enter the concepts in short form (separated by spaces):
        <input class="form-control" type="text" name="concepts" value="'.$strdisp.'" autocomplete="off"></p>
        <p style="text-align: left">Status (Completed or IN-PROGRESS):
        <input class="form-control" type="text" name="status" value="'.htmlentities($row['Status']).'" autocomplete="off"></p>
        <input class="form-control" type="hidden" name="SNo" value="'.htmlentities($row['SNo']).'" autocomplete="off">
        <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
    }
    elseif($_SESSION['table'] == "project"){
    	echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS FOR THE TABLE - PROJECT</h1>';
        if(isset($_POST['title']) && isset($_POST['company']) && isset($_POST['rolls']) && isset($_POST['faculty'])){
            if(strlen($_POST['title']) < 1 || strlen($_POST['rolls']) < 1 || strlen($_POST['faculty']) < 1){
                $_SESSION['error'] = 'Fill all the fields (Company field can be left empty)';
                header('Location: update.php?rec_id='.htmlentities($_POST['SNo'])) ;
                return;
            }
            $stmt = $pdo->prepare("SELECT Faculty_id FROM Faculty where Faculty_Name = :xyz");
            $stmt->execute(array(":xyz" => $_POST['faculty']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $_SESSION['error'] = 'Faculty Name not found in the table';
                header('Location: update.php?rec_id='.htmlentities($_POST['SNo']));
                return;
            }
            else{
                $fno = $row['Faculty_id'];
            }
            $stmt = $pdo->prepare("SELECT Company_id FROM Company where Company_Name = :xyz");
            $stmt->execute(array(":xyz" => $_POST['company']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $stmt = $pdo->query("SELECT MAX(Company_id) AS cno FROM company");
                $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row1 === false){
                    $compno = "Comp01";
                }
                else{
                    $temp = substr($row1['cno'],4) + 1;
                    if(strlen((string)$temp) == 1){
                        $compno = substr($row1['cno'],0,5).$temp;
                    }
                    else{
                        $compno = substr($row1['cno'],0,4).$temp;
                    }
                }
                $sql = "INSERT INTO Company (Company_id, Company_Name) VALUES (:val, :name)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                ':val' => $compno,
                ':name' => $_POST['company']));
            }
            else{
                $compno = $row['Company_id'];
            }
            $str = str_replace('  ',' ',$_POST['rolls']);
            $str_arr = explode(" ", $str);
            for($i=0; $i<count($str_arr); $i++){
                for($j=$i+1; $j<count($str_arr); $j++){
                    if(($str_arr[$i] == $str_arr[$j])){
                        $_SESSION['error'] = 'Repeated roll numbers found in the entry';
                        header('Location: update.php?rec_id='.htmlentities($_POST['SNo']));
                        return;
                    }
                }
            }
            for($i=0; $i<count($str_arr); $i++){
                //echo strlen($str_arr[$i]);
                $stmt = $pdo->prepare("SELECT * FROM student where Roll_Number = :xyz");
                $stmt->execute(array(":xyz" => $str_arr[$i]));
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row === false){
                    $_SESSION['error'] = 'Student with roll number '.$str_arr[$i].' not found in the table';
                    header('Location: update.php?rec_id='.htmlentities($_POST['SNo']));
                    //echo $str;
                    //print_r($str_arr);
                    //die();
                    return;break;
                }
                else{
                    continue;
                }
            }
            $stmt = $pdo->prepare("DELETE FROM batch_students where Batch_No = :val");
            $stmt->execute(array(":val" => $_POST['SNo']));
            $sql = "UPDATE batches SET Project_Title = :title, Company_ID = :comp, Faculty_ID = :fac WHERE Batch_No = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':val' => $_POST['SNo'],
            ':title' => $_POST['title'],
            ':comp' => $compno,
            ':fac' => $fno));
            for($i=0; $i<count($str_arr); $i++){
                $sql = "INSERT INTO batch_students (Batch_No, Roll_No) VALUES (:val, :roll)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                ':val' => $_POST['SNo'],
                ':roll' => $str_arr[$i]));
            }
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        $stmt = $pdo->prepare("SELECT * FROM Faculty f, batches b, company c WHERE f.Faculty_ID = b.Faculty_ID AND c.Company_ID = b.Company_ID AND Batch_No = :val");
        $stmt->execute(array(":val" => $_GET['rec_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ( $row === false ) {
            $_SESSION['error'] = 'The ID for the record to be updated is missing.';
            header( 'Location: edit_index.php' ) ;
            return;
        }
        $temp = $pdo->prepare("SELECT Roll_No FROM batch_students bs where bs.Batch_No = :param");
        $temp->execute(array(':param' => $_GET['rec_id']));
        $i = 0;
        $str_disarr = [];
        while($rowtemp = $temp->fetch(PDO::FETCH_ASSOC)){
            $str_disarr[$i] = $rowtemp['Roll_No'];
            $i = $i + 1;
        }
        $strdisp = implode(" ",$str_disarr);
        echo '<form method="post">
                <p style="text-align: left">Project Title:
                <input class="form-control" type="text" name="title" value="'.htmlentities($row['Project_Title']).'" autocomplete="off"></p>
                <p style="text-align: left">Faculty Name:
                <input class="form-control" type="text" name="faculty" value="'.htmlentities($row['Faculty_Name']).'" autocomplete="off"></p>
                <p style="text-align: left">Enter the Roll number of the students (separated by spaces):
                <input class="form-control" type="text" name="rolls" value="'.$strdisp.'" autocomplete="off"></p>
                <p style="text-align: left">Company Name:
                <input class="form-control" type="text" name="company" value="'.htmlentities($row['Company_Name']).'" autocomplete="off"></p>
                <input class="form-control" type="hidden" name="SNo" value="'.htmlentities($row['Batch_No']).'" autocomplete="off">
                <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
                <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
                </form>';
    }
    elseif($_SESSION['table'] == "faculty"){
        echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS FOR THE TABLE - FACULTY</h1>';
        if(isset($_POST['name'])){
            if(strlen($_POST['name']) < 1){
                $_SESSION['error'] = 'Fill in the faculty name';
                header('Location: insert.php') ;
                return;
            }
            $stmt = $pdo->prepare("SELECT Faculty_id FROM Faculty where Faculty_Name = :xyz");
            $stmt->execute(array(":xyz" => $_POST['name']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sql = "UPDATE Faculty SET Faculty_Name = :name WHERE Faculty_id = :val";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                ':val' => $_POST['facid'],
                ':name' => $_POST['name']));
                $_SESSION['success'] = 'Record Updated Successfully';
                unset($_SESSION['table']);
                header("Location: main.php");
                return;
            }
            else{
                $_SESSION['error'] = 'Faculty Name already available in the table';
                header('Location: main.php') ;
                return;
            }
        }
        $stmt = $pdo->prepare("SELECT * FROM Faculty WHERE Faculty_id = :xyz");
        $stmt->execute(array(":xyz" => $_GET['rec_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ( $row === false ) {
            $_SESSION['error'] = 'Some error occurred';
            header( 'Location: index.php' ) ;
            return;
        }
        echo '<form method="post">
        <p style="text-align: left">Faculty Name:
        <input class="form-control" type="text" name="name" value="'.htmlentities($row['Faculty_Name']).'" autocomplete="off"></p>
        <input class="btn btn-outline-Info" type="hidden" name="facid" value="'.htmlentities($row['Faculty_id']).'" autocomplete="off">
        <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>'; 
    }
    elseif($_SESSION['table'] == "student"){
        echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS FOR THE TABLE - STUDENTS</h1>';
        if(isset($_POST['name']) && isset($_POST['rollnum'])){
            if(strlen($_POST['name']) < 1){
                $_SESSION['error'] = 'Missing data';
                header('Location: insert.php') ;
                return;
            }
            $sql = "UPDATE student SET Student_Name = :name WHERE Roll_Number = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':val' => $_POST['rollnum'],
            ':name' => $_POST['name']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        $stmt = $pdo->prepare("SELECT * FROM student where Roll_Number = :xyz");
        $stmt->execute(array(":xyz" => $_GET['rec_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row === false){
            $_SESSION['error'] = 'Some error occurred';
            header( 'Location: index.php' ) ;
            return;
        }
        echo '<form method="post">
        <p style="text-align: left">Student Name:
        <input class="form-control" type="text" name="name" value="'.htmlentities($row['Student_Name']).'" autocomplete="off"></p>
        <input class="btn btn-outline-Info" type="hidden" name="rollnum" value="'.htmlentities($row['Roll_Number']).'" autocomplete="off">
        <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
    }
    elseif($_SESSION['table'] == "concept"){
        echo '<h1 style="margin-bottom: 80px">UPDATING THE RECORDS FOR THE TABLE - CONCEPTS</h1>';
        if(isset($_POST['short']) && isset($_POST['long'])){
            if(strlen($_POST['short']) < 1 || strlen($_POST['long']) < 1){
                $_SESSION['error'] = 'Missing data';
                header('Location: insert.php') ;
                return;
            }
            $sql = "UPDATE concepts SET C_Field = :field, C_Title = :title WHERE C_No = :val";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                            ':val' => $_POST['cno'],
                            ':field' => $_POST['short'],
                            ':title' => $_POST['long']));
            $_SESSION['success'] = 'Record Updated Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        $stmt = $pdo->prepare("SELECT * FROM concepts where C_No = :xyz");
        $stmt->execute(array(":xyz" => $_GET['rec_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row === false){
            $_SESSION['error'] = 'Some error occurred';
            header( 'Location: index.php' ) ;
            return;
        }
        echo '<form method="post">
        <p style="text-align: left">Concept Short form:
        <input class="form-control" type="text" name="short" value="'.htmlentities($row['C_Field']).'" autocomplete="off"></p>
        <p style="text-align: left">Concept Full form:
        <input class="form-control" type="text" name="long" value="'.htmlentities($row['C_Title']).'" autocomplete="off"></p>
        <input class="btn btn-outline-Info" type="hidden" name="cno" value="'.htmlentities($row['C_No']).'" autocomplete="off">
        <p style="margin-top: 40px"><input style="margin-right: 10px" class="btn btn-outline-Success" type="submit" name="submit" value="Submit">
        <input class="btn btn-outline-Warning" type="submit" name="back" value="Back"></p>
        </form>';
    }
    else{
        $_SESSION['error'] = 'Some error occured. Try again';
        header('Location: main.php') ;
        return;
    }
}
else{
    $_SESSION['error'] = "Error occured. Try again";
    header("Location: main.php"); 
}
?>
</body>
</html>