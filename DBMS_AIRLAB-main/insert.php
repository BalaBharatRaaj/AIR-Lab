<?php
require_once "pdo.php";
session_start();?>
<html>
<head>
    <title>Record to be inserted</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <center><div class="container" style="margin: 20px;padding-left: : 50px">
<?php
if (isset($_SESSION['error']) ) {
    echo '<div class="alert alert-primary" role="alert">'.$_SESSION['error']."</div>\n";
    unset($_SESSION['error']);
}
if(isset($_POST['back'])){
    header("Location: main.php");
    unset($_SESSION['device']);
    unset($_SESSION['device_table']);
    unset($_SESSION['table']);
    return;
}
if(isset($_SESSION['table'])){
    if($_SESSION['table'] == "Moudetails"){
        echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - MEMORANDUM OF UNDERSTANDING (MoU)</h1>';
        if(isset($_POST['outcome']) && isset($_POST['MoUSignal'])){
            if (strlen($_POST['outcome']) < 1 || strlen($_POST['MoUSignal']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM MoU_Details");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sno = 1;
            }
            else{
                $sno = $row['maxno'] + 1;
            }
            $sql = "INSERT INTO mou_details (SNo, Outcome, MoU_Signal_with) VALUES (:val, :out, :mousig)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $sno,
                ':out' => $_POST['outcome'],
                ':mousig' => $_POST['MoUSignal']));
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        echo '<form method="post">
        <input class="form-control" type="text" name="outcome" placeholder="Outcome" autocomplete="off"><br>
        <input class="form-control" type="text" name="MoUSignal" placeholder="MoUSignal" autocomplete="off"><br>
        <p style="margin-top: 20px">
        <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px">
        <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
        </p>
        </form>';
    }
    elseif($_SESSION['table'] == "private"){
        echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - PRIVATE CLOUD</h1>';
        if(isset($_POST['cloud']) && isset($_POST['capab']) && isset($_POST['Iaas'])){
            if (strlen($_POST['cloud']) < 1 || strlen($_POST['capab']) < 1 || strlen($_POST['Iaas']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM private_cloud");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sno = 1;
            }
            else{
                $sno = $row['maxno'] + 1;
            }
            $sql = "INSERT INTO private_cloud (SNo, Cloud_Type, Capabilities, Iaas) VALUES (:val, :cloud, :capab, :iaas)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $sno,
                ':cloud' => $_POST['cloud'],
                ':capab' => $_POST['capab'],
                ':iaas' => $_POST['Iaas']));
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        echo '<form method="post">
        <input class="form-control" type="text" name="cloud" placeholder="Cloud_Type" autocomplete="off"><br>
        <input class="form-control" type="text" name="capab" placeholder="Capabilities" autocomplete="off"><br>
        <input class="form-control" type="text" name="Iaas" placeholder="Iaas" autocomplete="off"><br>
        <p style="margin-top: 40px">
        <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
        <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
        </p>
        </form>';
    }
    elseif($_SESSION['table'] == "funds"){
        echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - FUNDS RECEIVED</h1>';
        if(isset($_POST['desc']) && isset($_POST['from']) && isset($_POST['to']) && isset($_POST['grants'])){
            if (strlen($_POST['desc']) < 1 || strlen($_POST['from']) < 1 || strlen($_POST['to']) < 1 || strlen($_POST['grants']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            if(!(is_numeric($_POST['from']) && is_numeric($_POST['to']) && is_numeric($_POST['grants']))){
                $_SESSION['error'] = 'Enter numeric values in From_year, To_year and Grants_Received fields';
                header("Location: insert.php");
                return;
            }
            $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM funds_generated");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sno = 1;
            }
            else{
                $sno = $row['maxno'] + 1;
            }
            $sql = "INSERT INTO funds_generated (SNo, Description, From_Year, To_Year, Grants_Received) VALUES (:val, :descr, :fromy, :to, :grants)";
            $stmt = $pdo->prepare($sql);
            $sim = $_POST['grants']." Lakhs";
            $stmt->execute(array(
                ':val' => $sno,
                ':descr' => $_POST['desc'],
                ':fromy' => $_POST['from'],
                ':to' => $_POST['to'],
                ':grants' => $sim));
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        echo '<form method="post">
        <input class="form-control" type="text" name="desc" placeholder="Description" autocomplete="off"><br>
        <input class="form-control" type="text" name="from" placeholder="From_Year" autocomplete="off"><br>
        <input class="form-control" type="text" name="to" placeholder="To_Year" autocomplete="off"><br>
        <input class="form-control" type="text" name="grants" placeholder="Grants_Received (Enter only the numeric value in Lakhs)" autocomplete="off"><br>
        <p style="margin-top: 40px">
        <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px">
        <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
        </p>
        </form>';
    }
    elseif($_SESSION['table'] == "datacenter"){
        echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - CLOUD DATA CENTER</h1>';
        if(isset($_POST['comp']) && isset($_POST['desc'])){
            if (strlen($_POST['comp']) < 1 || strlen($_POST['desc']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM cloud_data_center");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sno = 1;
            }
            else{
                $sno = $row['maxno'] + 1;
            }
            $sql = "INSERT INTO cloud_data_center (SNo, Component_Name, Description) VALUES (:val, :comp, :descr)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $sno,
                ':comp' => $_POST['comp'],
                ':descr' => $_POST['desc']));
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        echo '<form method="post">
        <input class="form-control" type="text" name="comp" placeholder="Component_Name" autocomplete="off"><br>
        <input class="form-control" type="text" name="desc" placeholder="Description" autocomplete="off"><br>
        <p style="margin-top: 40px">
        <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
        <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
        </p>
        </form>';
    }
    elseif($_SESSION['table'] == "serverconfig"){
        echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - AIR LAB SERVER CONFIGURATION</h1>';
        if(isset($_POST['hd']) && isset($_POST['dvd']) && isset($_POST['ram']) && isset($_POST['processor']) && isset($_POST['name'])){
            if (strlen($_POST['ram']) < 1 || strlen($_POST['processor']) < 1 || strlen($_POST['name']) < 1) {
                $_SESSION['error'] = 'Missing data';
                header("Location: insert.php");
                return;
            }
            $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM air_lab_server");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sno = 1;
            }
            else{
                $sno = $row['maxno'] + 1;
            }
            $sql = "INSERT INTO air_lab_server (SNo, HD, DVD, RAM, Processor, Name) VALUES (:val, :hd, :dvd, :ram, :pro, :name)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':val' => $sno,
                ':hd' => $_POST['hd'],
                ':dvd' => $_POST['dvd'],
                ':ram' => $_POST['ram'],
                ':pro' => $_POST['processor'],
                ':name' => $_POST['name']));
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
        }
        echo '<form method="post">
        <input class="form-control" type="text" name="name" placeholder="Name" autocomplete="off"><br>
        <input class="form-control" type="text" name="hd" placeholder="HD" autocomplete="off"><br>
        <input class="form-control" type="text" name="dvd" placeholder="DVD" autocomplete="off"><br>
        <input class="form-control" type="text" name="ram" placeholder="RAM" autocomplete="off"><br>
        <input class="form-control" type="text" name="processor" placeholder="Processor" autocomplete="off"><br>
        <p style="margin-top: 40px">
        <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
        <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
        </p>
        </form>';
    }
    elseif($_SESSION['table'] == "security"){
        if(isset($_POST['device_table']) || isset($_SESSION['device_table'])){
            if(!isset($_SESSION['device_table'])){$_SESSION['device_table'] = $_POST['device_table'];}
            if($_SESSION['device_table'] == "with_statistics"){
                echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - DEVICE WITH STATISTICS</h1>';
                if(isset($_POST['device']) && isset($_POST['feature']) && isset($_POST['users']) && isset($_POST['logs'])){
                    if (strlen($_POST['device']) < 1 || strlen($_POST['feature']) < 1 || strlen($_POST['users']) < 1 || strlen($_POST['logs']) < 1) {
                        $_SESSION['error'] = 'Missing data';
                        header("Location: insert.php");
                        return;
                    }
                    if(!(is_numeric($_POST['users']) && is_numeric($_POST['logs']))){
                        $_SESSION['error'] = 'Enter numeric values in No. of Users and Logs fields';
                        header("Location: insert.php");
                        return;
                    }
                    $stmt = $pdo->prepare("SELECT Device_ID FROM Devices where Device_Name = :xyz");
                    $stmt->execute(array(":xyz" => $_POST['device']));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row === false){
                        $stmt = $pdo->query("SELECT MAX(Device_ID) AS dno FROM devices");
                        $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                        if($row1 === false){
                            $sno = "D01";
                        }
                        else{
                            $temp = substr($row1['dno'],2) + 1;
                            if(strlen($temp) == 1){
                                $dno = substr($row1['dno'],0,2).$temp;
                            }
                            else{
                                $dno = substr($row1['dno'],0,1).$temp;
                            }
                        }
                        $sql = "INSERT INTO Devices (Device_ID, Device_Name) VALUES (:val, :name)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(
                        ':val' => $sno,
                        ':name' => $_POST['device']));
                    }
                    else{
                        $sno = $row['Device_ID'];
                    }
                    $stmt = $pdo->prepare("SELECT F_ID FROM Features where F_Name = :xyz");
                    $stmt->execute(array(":xyz" => $_POST['feature']));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row === false){
                        $stmt = $pdo->query("SELECT MAX(F_ID) AS dno FROM features");
                        $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                        if($row1 === false){
                            $fno = "F_1";
                        }
                        else{
                            $temp = substr($row['dno'],2) + 1;
                            $fno = substr($row['dno'],0,2).$temp;
                        }
                        $sql = "INSERT INTO Features (F_ID, F_Name) VALUES (:val, :name)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(
                        ':val' => $fno,
                        ':name' => $_POST['feature']));
                    }
                    else{
                        $fno = $row['F_ID'];
                    }
                    try{
                        $sql = "INSERT INTO device_with_statistics (Device_ID, F_ID, No_of_Users, Logs) VALUES (:dno, :fno, :user, :log)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(
                            ':dno' => $sno,
                            ':fno' => $fno,
                            ':user' => $_POST['users'],
                            ':log' => $_POST['logs']));
                        $_SESSION['success'] = 'Record Added Successfully';
                        unset($_SESSION['table']);
                        unset($_SESSION['device_table']);
                        header("Location: main.php");
                    }
                    catch(Exception $e){
                        $_SESSION['error'] = "This combination is already available";
                        unset($_SESSION['table']);
                        unset($_SESSION['device_table']);
                        header("Location: main.php");
                    }
                }
                else{
                    echo '<form method="post">
                    <input class="form-control" type="text" name="device" placeholder="Device_Name" autocomplete="off"><br>
                    <input class="form-control" type="text" name="feature" placeholder="Feature Name" autocomplete="off"><br>
                    <input class="form-control" type="text" name="users" placeholder="Number of Users (in numbers)" autocomplete="off"><br>
                    <input class="form-control" type="text" name="logs" placeholder="Logs (in numbers)" autocomplete="off"><br>
                    <p style="margin-top: 40px">
                    <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
                    <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
                    </p>
                    </form>';
                }
            }
            elseif($_SESSION['device_table'] == "without_statistics"){
                echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - DEVICE WITHOUT STATISTICS</h1>';
                if(isset($_POST['device']) && isset($_POST['quantity'])){
                    if (strlen($_POST['device']) < 1 || strlen($_POST['quantity']) < 1) {
                        $_SESSION['error'] = 'Missing data';
                        header("Location: insert.php");
                        return;
                    }
                    if(!(is_numeric($_POST['quantity']))){
                        $_SESSION['error'] = 'Enter numeric values in quantity field';
                        header("Location: insert.php");
                        return;
                    }
                    $stmt = $pdo->prepare("SELECT Device_ID FROM Devices where Device_Name = :xyz");
                    $stmt->execute(array(":xyz" => $_POST['device']));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row === false){
                        $stmt = $pdo->query("SELECT MAX(Device_ID) AS dno FROM devices");
                        $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                        if($row1 === false){
                            $dno = "D01";
                        }
                        else{
                            $temp = substr($row1['dno'],2) + 1;
                            if(strlen((string)$temp) == 1){
                                $dno = substr($row1['dno'],0,2).$temp;
                            }
                            else{
                                $dno = substr($row1['dno'],0,1).$temp;
                            }
                        }
                        $sql = "INSERT INTO Devices (Device_ID, Device_Name) VALUES (:val, :name)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(
                        ':val' => $dno,
                        ':name' => $_POST['device']));
                    }
                    else{
                        $dno = $row['Device_ID'];
                    }
                    $stmt = $pdo->query("SELECT MAX(SNo) AS maxno FROM device_without_statistics");
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row === false){
                        $sno = 1;
                    }
                    else{
                        $sno = $row['maxno'] + 1;
                    }
                    try{
                        $sql = "INSERT INTO device_without_statistics (SNo, Quantity, Device_ID) VALUES (:sno, :quan, :dno)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(
                            ':dno' => $dno,
                            ':sno' => $sno,
                            ':quan' => $_POST['quantity']));
                        $_SESSION['success'] = 'Record Added Successfully';
                        unset($_SESSION['table']);
                        unset($_SESSION['device_table']);
                        header("Location: main.php");
                    }
                    catch(Exception $e){
                        $_SESSION['error'] = "This combination is already available";
                        unset($_SESSION['table']);
                        unset($_SESSION['device_table']);
                        header("Location: main.php");
                    }
                }
                echo '<form method="post">
                <input class="form-control" type="text" name="device" placeholder="Device Name" autocomplete="off"><br>
                <input class="form-control" type="text" name="quantity" placeholder="Quantity" autocomplete="off"><br>
                <p style="margin-top: 40px">
                <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
                <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
                </p>
                </form>'; 
            }   
            else{
                $_SESSION['error'] = 'Error occured. Choose the tables again and proceed';
                unset($_SESSION['device_table']);
                unset($_SESSION['table']);
                header("Location: main.php");
                return;
            }
        }
        if(!isset($_SESSION['device_table'])){
            echo '<h1 style="margin-bottom: 60px">SELECT A TABLE</h1>';
            echo '<form method = "post">
            <input type="radio"  class="btn-check" id="with" name="device_table" value="with_statistics" autocomplete="off">
            <label class="btn btn-outline-primary" for="with" style="margin: 10px">Device with Statistics Table</label><br>
            <input type="radio"  class="btn-check" id="without" name="device_table" value="without_statistics" autocomplete="off">
            <label class="btn btn-outline-primary" for="without" style="margin: 10px">Device without Statistics Table</label><br>
            <p style="margin-top: 40px">
            <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
            <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
            </p></form>';
        }
    }
    elseif($_SESSION['table'] == "research"){
        echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - RESEARCH</h1>';
        if(isset($_POST['title']) && isset($_POST['status']) && isset($_POST['concepts']) && isset($_POST['faculty'])){
            if(strlen($_POST['title']) < 1 || strlen($_POST['concepts']) < 1 || strlen($_POST['status']) < 1 || strlen($_POST['faculty']) < 1){
                $_SESSION['error'] = 'Fill all the fields';
                header('Location: insert.php') ;
                return;
            }
            $stmt = $pdo->prepare("SELECT Faculty_id FROM Faculty where Faculty_Name = :xyz");
            $stmt->execute(array(":xyz" => $_POST['faculty']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $_SESSION['error'] = 'Faculty Name not found in the table';
                header("Location: insert.php");
                return;
            }
            else{
                $fno = $row['Faculty_id'];
            }
            $str = str_replace('  ',' ',$_POST['concepts']);
            $str_arr = explode(" ", $str);
            for($i=0; $i<count($str_arr); $i++){
                for($j=$i+1; $j<count($str_arr); $j++){
                    if(($str_arr[$i] == $str_arr[$j])){
                        $_SESSION['error'] = 'Repeated concept values found in the entry';
                        header("Location: insert.php");
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
                    header("Location: insert.php");
                    return;break;
                }
                else{
                    continue;
                }
            }
            $stmt = $pdo->query("SELECT MAX(SNo) AS sno FROM research");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sno = 1;
            }
            else{
                $sno = $row['sno'] + 1;
            }
            $sql = "INSERT INTO research (SNo, Title, Status, Faculty_ID) VALUES (:val, :title, :stat, :fac)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':val' => $sno,
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
                ':val' => $sno,
                ':cno' => $rowtemp['C_No']));
            }
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        echo '<form method="post">
        <input class="form-control" type="text" name="faculty" placeholder="Faculty Name (as in faculty table)" autocomplete="off"><br>
        <input class="form-control" type="text" name="title" placeholder="Research Title" autocomplete="off"><br>
        <input class="form-control" type="text" name="concepts" placeholder="Enter the Concepts short form (separated by spaces)" autocomplete="off"><br>
        <input class="form-control" type="text" name="status" placeholder="Status (Completed or IN-PROGRESS)" autocomplete="off"><br>
        <p style="margin-top: 40px">
        <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
        <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
        </p>
        </form>';
    }
    elseif($_SESSION['table'] == "project"){
        echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - PROJECT</h1>';
        if(isset($_POST['title']) && isset($_POST['company']) && isset($_POST['rolls']) && isset($_POST['faculty'])){
            if(strlen($_POST['title']) < 1 || strlen($_POST['rolls']) < 1 || strlen($_POST['faculty']) < 1){
                $_SESSION['error'] = 'Fill all the fields (Company field can be left empty)';
                header('Location: insert.php') ;
                return;
            }
            $stmt = $pdo->prepare("SELECT Faculty_id FROM Faculty where Faculty_Name = :xyz");
            $stmt->execute(array(":xyz" => $_POST['faculty']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $_SESSION['error'] = 'Faculty Name not found in the table';
                header("Location: insert.php");
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
                        header("Location: insert.php");
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
                    header("Location: insert.php");
                    //echo $str;
                    //print_r($str_arr);
                    //die();
                    return;break;
                }
                else{
                    continue;
                }
            }
            $stmt = $pdo->query("SELECT MAX(Batch_No) AS bno FROM batches");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $batno = 1;
            }
            else{
                $batno = $row['bno'] + 1;
            }
            $sql = "INSERT INTO batches (Batch_No, Project_Title, Company_ID, Faculty_ID) VALUES (:val, :title, :comp, :fac)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
            ':val' => $batno,
            ':title' => $_POST['title'],
            ':comp' => $compno,
            ':fac' => $fno));
            for($i=0; $i<count($str_arr); $i++){
                $sql = "INSERT INTO batch_students (Batch_No, Roll_No) VALUES (:val, :roll)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                ':val' => $batno,
                ':roll' => $str_arr[$i]));
            }
            $_SESSION['success'] = 'Record Added Successfully';
            unset($_SESSION['table']);
            header("Location: main.php");
            return;
        }
        echo '<form method="post">
        <input class="form-control" type="text" name="title" placeholder="Project Title" autocomplete="off"><br>
        <input class="form-control" type="text" name="faculty" placeholder="Faculty Name (as in faculty table)" autocomplete="off"><br>
        <input class="form-control" type="text" name="rolls" placeholder="Enter the Student Roll numbers (separated by spaces)" autocomplete="off"><br>
        <input class="form-control" type="text" name="company" placeholder="Enter the name of the Sponser" autocomplete="off"><br>
        <p style="margin-top: 40px">
        <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
        <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
        </p>
        </form>';
    }
    elseif($_SESSION['table'] == "faculty"){
        echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - FACULTY</h1>';
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
                $stmt = $pdo->query("SELECT MAX(Faculty_id) AS fno FROM faculty");
                $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row1 === false){
                    $sno = "PSG_CSE_01";
                }
                else{
                    $temp = substr($row1['fno'],8) + 1;
                    if(strlen((string)$temp) == 1){
                        $sno = substr($row1['fno'],0,9).$temp;
                    }
                    else{
                        $sno = substr($row1['fno'],0,8).$temp;
                    }
                }
                $sql = "INSERT INTO Faculty (Faculty_id, Faculty_Name) VALUES (:val, :name)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                ':val' => $sno,
                ':name' => $_POST['name']));
                $_SESSION['success'] = 'Record Added Successfully';
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
        echo '<form method="post">
        <input class="form-control" type="text" name="name" placeholder="Faculty Name(with initials and titles)" autocomplete="off"><br>
        <p style="margin-top: 40px">
        <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
        <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
        </p>
        </form>';
    }
    elseif($_SESSION['table'] == "student"){
        echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - STUDENTS</h1>';
        if(isset($_POST['name']) && isset($_POST['rollnum'])){
            if(strlen($_POST['name']) < 1 || strlen($_POST['rollnum']) < 1){
                $_SESSION['error'] = 'Missing data';
                header('Location: insert.php') ;
                return;
            }
            $stmt = $pdo->prepare("SELECT * FROM student where Roll_number = :xyz");
            $stmt->execute(array(":xyz" => $_POST['rollnum']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $sql = "INSERT INTO student (Roll_Number, Student_Name) VALUES (:val, :name)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                ':val' => $_POST['rollnum'],
                ':name' => $_POST['name']));
                $_SESSION['success'] = 'Record Added Successfully';
                unset($_SESSION['table']);
                header("Location: main.php");
                return;
            }
            else{
                $_SESSION['error'] = 'Student Roll number already available in the table';
                header('Location: main.php') ;
                return;
            }
        }
        echo '<form method="post">
        <input class="form-control" type="text" name="rollnum" placeholder="Roll Number" autocomplete="off"><br>
        <input class="form-control" type="text" name="name" placeholder="Student Name" autocomplete="off"><br>
        <p style="margin-top: 40px">
        <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
        <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
        </p>
        </form>'; 
    }
    elseif($_SESSION['table'] == "concept"){
        echo '<h1 style="margin-bottom: 80px">INSERTING THE RECORDS FOR THE TABLE - CONCEPTS</h1>';
        if(isset($_POST['short']) && isset($_POST['long'])){
            if(strlen($_POST['short']) < 1 || strlen($_POST['long']) < 1){
                $_SESSION['error'] = 'Missing data';
                header('Location: insert.php') ;
                return;
            }
            $stmt = $pdo->prepare("SELECT * FROM concepts where C_Field = :val or C_Title = :xyz");
            $stmt->execute(array(":val" => $_POST['short'],
                                 ":xyz" => $_POST['long']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row === false){
                $stmt = $pdo->query("SELECT MAX(C_No) AS cno FROM concepts");
                $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row1 === false){
                    $dno = "c_01";
                }
                else{
                    $temp = substr($row1['cno'],2) + 1;
                    if(strlen((string)$temp) == 1){
                        $dno = substr($row1['cno'],0,2).$temp;
                    }
                    else{
                        $dno = substr($row1['cno'],0,3).$temp;
                    }
                }
                $sql = "INSERT INTO concepts (C_No, C_Field, C_Title) VALUES (:val, :field, :title)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                ':val' => $dno,
                ':field' => $_POST['short'],
                ':title' => $_POST['long']));
                $_SESSION['success'] = 'Record Added Successfully';
                unset($_SESSION['table']);
                header("Location: main.php");
                return;
            }
            else{
                $_SESSION['error'] = 'Concept already available. Please check the concepts table';
                header('Location: main.php') ;
                return;
            }
        }
        echo '<form method="post">
        <input class="form-control" type="text" name="short" placeholder="Concept Short form" autocomplete="off"><br>
        <input class="form-control" type="text" name="long" placeholder="Concept Full form" autocomplete="off"><br>
        <p style="margin-top: 40px">
        <input class="btn btn-outline-success"type="submit" name = "submit" value="Submit" style="margin-right:10px; ">
        <input class="btn btn-outline-Danger" type="submit" name = "back" value="Back">
        </p>
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
</div>
</center>
</body>
</html>
