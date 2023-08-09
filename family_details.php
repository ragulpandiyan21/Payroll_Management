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
    <title>FAMILY DETAILS</title>
    <link  rel="stylesheet"  href="family__det.css">
</head>
<body>
    <form action = "" method = "post">
    <img src="image1.png" class = "backgroundimage">
    <br><br><h2><B>FAMILY DETAILS</B></h2><br><br>
    <form>
        <label class="mar"><B>MARITAL STATUS :</B></label>
            <select class="mars" name = "Marstat">
                <option>Select</option>
                <option>Single</option>
                <option>Married</option>
                <option>Widow</option>
            </select><br><br><br>
        <label ><B> NUMBER OF CHILDREN :</B></label>
            <input type="number" placeholder="number of children" class="child" name = "childcount" value =  "<?php if(isset($_POST["next"]) ) {echo $_POST['childcount'];}?>"><br><br><br>
        <label class="fat" ><B>FATHERS'S NAME :</B></label>
            <input type="name" placeholder="father's name" class="fath" name = "fname" value =  "<?php if(isset($_POST["next"]) ) {echo $_POST['fname'];}?>"><br><br><br>
        <label class="mot" ><B>MOTHERS'S NAME :</B></label>
            <input type="text" placeholder="mother's name" class="moth" name = "mname" value =  "<?php if(isset($_POST["next"]) ) {echo $_POST['mname'];}?>"><br><br><br>
        <label class="hus"><B>HUSBAND'S/WIFE'S NAME :</B></label>
            <input type="text" placeholder="husband/wife" class="husb" name = "pname" value =  "<?php if(isset($_POST["next"]) ) {echo $_POST['pname'];}?>"><br><br><br>
        <label ><B>EMERGENCY NUMBER :</B></label>
            <input type="number" placeholder="emergency number" class="emer" name = "emenum" value =  "<?php if(isset($_POST["next"]) ) {echo $_POST['emenum'];}?>"><br><br><br>
        <button type = "submit" name = "next"><b>NEXT</b></button>
</form>
</body>
</html> 

<?php
require_once "connection.php";
if(isset($_POST["next"])){
    $emp_Marstat = $_POST["Marstat"];
    $emp_Ccount = $_POST["childcount"];
    $emp_Fname = $_POST["fname"];
    $emp_Mname = $_POST["mname"];
    $emp_Sname = $_POST["pname"];
    $emp_Emecon = $_POST["emenum"];
    if($emp_Emecon != NULL and $emp_Marstat!= NULL){
        $_SESSION["emp_marstat"] = $emp_Marstat;
        $_SESSION["emp_ccount"] = $emp_Ccount;
        $_SESSION["emp_fname"] = $emp_Fname;
        $_SESSION["emp_mname"] = $emp_Mname;
        $_SESSION["emp_sname"] = $emp_Sname;
        $_SESSION["emp_emecon"] = $emp_Emecon;
        header("location: experience.php"); 
    }
    else{
        {echo '<script type="text/javascript">
        window.onload = function () { alert("Mandatory fields are required"); } 
        </script>';} 
    }
}