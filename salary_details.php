<?php
session_start();
require_once "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALARY</title>
    <link rel="stylesheet" href="salary_details.css">
</head>
<body>
    <h2>SALARY</h2>
    <form action = "" method = "post">
    <img src="image1.png" class = "backgroundimage">
    <div>
   <br> <label>ROLE</label><input type="text" class="roll" name = "role" value =  "<?php if(isset($_POST["prev"]) or isset($_POST["next"])) {echo $_SESSION["emp_role"];}?>"><br><br>
    <label>BASIC SALARY</label><input type="number" class="basic" name = "basic" value =  "<?php if(isset($_POST["prev"]) or isset($_POST["next"])) {echo $_POST['basic'];}?>"><br><br>
    <label>DEARNESS ALLOWANCE</label><input type="number" class="da"  name="da" value =  "<?php if(isset($_POST["prev"]) or isset($_POST["next"])) {echo $_POST['da'];}?>"><br><br>
    <label>HOUSE RENT ALLOWANCE</label><input type="number"class="hra" name = "hra" value =  "<?php if(isset($_POST["prev"]) or isset($_POST["next"])) {echo $_POST['hra'];}?>"><br><br>
</div>

    <div>
        <label>BUS FARE</label>
        <select calss="bus" name  = "BAopt" value =  "<?php if(isset($_POST["prev"]) or isset($_POST["next"])) {echo $_POST['BAopt'];}?>">
            <option>SELECT</option>
            <option>YES</option>
            <option>NO</option>
        </select>
        <label class="time">TIME IN</label><input type="time" name = "intime" value =  "<?php if(isset($_POST["prev"]) or isset($_POST["next"])) {echo $_POST['intime'];}?>"><br><br>
    </div>

    <div>
        <label>ELIGIBLE  AMOUNT</label><input type="number" class="ea" name = "BAall" value =  "<?php if(isset($_POST["prev"]) or isset($_POST["next"])) {echo $_POST['BAall'];}?>">
        <label class="too">TIME OUT</label><input type="time" class="to" name = "outtime" value =  "<?php if(isset($_POST["prev"]) or isset($_POST["next"])) {echo $_POST['outtime'];}?>"><br><br>
    </div>

    <div>
        <label>WORKING HOURS</label><input type="time"class="working" name = "wh" value =  "<?php if(isset($_POST["prev"]) or isset($_POST["next"])) {echo $_POST['wh'];}?>">
        <label class="join">DATE OF JOINING</label><input type="date" name = "DOJ" value =  "<?php if(isset($_POST["prev"]) or isset($_POST["next"])) {echo $_POST['DOJ'];}?>"><br><br>
    </div>

    <div class="but">
            <button class="but1" name = "prev"><b>PREV</b></button>
            <button class="but2" name = "next"><b>NEXT</b></button>
    </div>
</form>
</body>
</html>

<?php
require_once "db_connection.php";

if(isset($_POST["prev"])){
    $emp_Role = $_POST["role"];
    $emp_Basic = $_POST["basic"];
    $emp_Da = $_POST["da"];
    $emp_Hra = $_POST["hra"];
    $emp_Baopt = $_POST["BAopt"];
    $emp_Intime = $_POST["intime"];
    $emp_Outtime = $_POST["outtime"];
    $emp_BAall = $_POST["BAall"];
    $emp_Wh = $_POST["wh"];
    $emp_Doj = $_POST["DOJ"];
    $_SESSION["emp_role"] = $emp_Role;
    $_SESSION["emp_basic"] = $emp_Basic;
    $_SESSION["emp_da"] = $emp_Da;
    $_SESSION["emp_hra"] = $emp_Hra;
    $_SESSION["emp_baopt"] = $emp_Baopt;
    $_SESSION["emp_intime"] = $emp_Intime;
    $_SESSION["emp_outtime"] = $emp_Outtime;
    $_SESSION["emp_baall"] = $emp_BAall;
    $_SESSION["emp_wh"] = $emp_Wh;
    $_SESSION["emp_doj"] = $emp_Doj;
    header("location: experience_details.php");
}

if(isset($_POST["next"])){
    $emp_Role = $_POST["role"];
    $emp_Basic = $_POST["basic"];
    $emp_Da = $_POST["da"];
    $emp_Hra = $_POST["hra"];
    $emp_Baopt = $_POST["BAopt"];
    $emp_Intime = $_POST["intime"];
    $emp_Outtime = $_POST["outtime"];
    $emp_BAall = $_POST["BAall"];
    $emp_Wh = $_POST["wh"];
    $emp_Doj = $_POST["DOJ"];
    if($emp_Role != NULL and $emp_Basic != NULL and $emp_Da != NULL){
        $_SESSION["emp_role"] = $emp_Role;
        $_SESSION["emp_basic"] = $emp_Basic;
        $_SESSION["emp_da"] = $emp_Da;
        $_SESSION["emp_hra"] = $emp_Hra;
        $_SESSION["emp_baopt"] = $emp_Baopt;
        $_SESSION["emp_intime"] = $emp_Intime;
        $_SESSION["emp_outtime"] = $emp_Outtime;
        $_SESSION["emp_baall"] = $emp_BAall;
        $_SESSION["emp_wh"] = $emp_Wh;
        $_SESSION["emp_doj"] = $emp_Doj;
        header("location: bank_details.php");
    }
    else{
        {echo '<script type="text/javascript">
        window.onload = function () { alert("Mandatory fields are required"); } 
        </script>';} 
    }
}