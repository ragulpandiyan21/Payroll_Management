<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary</title>
    <link rel="stylesheet" href="salary21.css">
</head>
<body>
    <div class="container">
    <form action = "" method = "post">
    <img src="image1.png" class = "backgroundimage">
    <h2>SALARY</h2>
        <!--label>NAME: <input type="text" placeholder="NAME" class="name" name = "emp_name" value="<?php if($_SESSION["enter"] == true) {echo $_SESSION["empname"];}?>"></label>
        <label>ROLE: <input type="text" placeholder="ROLE" class="role" name = "emp_role" value = "<?php if($_SESSION["enter"] == true) {echo $_SESSION["emprole"];}?>"></label-->
        <label>WORKED DAYS: <input type="NUMBER" placeholder="worked_days" class="wd" name = "wrkdays"></label>
        <label>OT WAGES: 
        <select class="ot" name = "otopt">
            <option>Select</option>
            <option>Yes</option>
            <option>No</option>
        </select></label>
        <label >OT AMOUNT: <input type="number" placeholder="OT" class="ota" name="otamt"></label>
        <label>SALARY ADVANCE: 
        <select class="as" name = "advopt">
            <option>Select</option>
            <option>Yes</option>
            <option>No</option>
        </select></label>
        <label>ADVANCE AMOUNT: <input type="number" placeholder="ADVANCE AMOUNT" class="aa" name = "advamt"></label><br>
        <button action = "submit" name = "enter">ENTER</button>
        <button action = "submit" name = "logout">LOG OUT</button>
    </form>
    </div>
</body>
</html>

<?php
require_once "db_connection.php";

if(isset($_POST["enter"])){
    if($_SESSION["sal_mon"] == "JAN" or $_SESSION["sal_mon"] == "MAR" or $_SESSION["sal_mon"] == "MAY" or $_SESSION["sal_mon"] == "JUL" or $_SESSION["sal_mon"] == "AUG" or $_SESSION["sal_mon"] == "OCT" or $_SESSION["sal_mon"] == "DEC" ){
        $maxwrka = 31;
        if($_POST["wrkdays"] > $maxwrka){
            {echo '<script type="text/javascript">
            window.onload = function () { alert("Worked days exceed maximum days"); } 
            </script>';} 
        }
        else{
            calsal($conn, $_POST["wrkdays"], $maxwrka);
        }
    }
    if($_SESSION["sal_mon"] == "APR" or $_SESSION["sal_mon"] == "JUN" or $_SESSION["sal_mon"] == "SEP" or $_SESSION["sal_mon"] == "NOV"){
        $maxwrkb = 30;
        if($_POST["wrkdays"] > $maxwrkb){
            {echo '<script type="text/javascript">
            window.onload = function () { alert("Worked days exceed maximum days"); } 
            </script>';} 
        }
        else{
            calsal($conn, $_POST["wrkdays"], $maxwrkb);
        }
    }
    if($_SESSION["sal_mon"] == "FEB"){
        $maxwrkc = 28;
        if($_POST["wrkdays"] > $maxwrkc){
            {echo '<script type="text/javascript">
            window.onload = function () { alert("Worked days exceed maximum days"); } 
            </script>';} 
        }
        else{
            calsal($conn, $_POST["wrkdays"], $maxwrkc);
        }
    }
}


function calsal($conn, $present, $max){
    require_once "connection.php";
    $a = getbasic($conn, $_SESSION["empid"]);
    $b = getDA($conn, $_SESSION["empid"]);
    $c = gethra($conn, $_SESSION["empid"]);
    $_SESSION["basic"] = $a;
    $_SESSION["da"] = $b;
    $_SESSION["hra"] = $c;
    $emp_esic = 0.0075;
    $empr_esic = 0.0175;
    $emp_pfc = 0.12;
    $empr_pfc = 0.12;
    if(($max-$present)<=6){
        $additional_days = $present-($max-6);
        $worked_days = $max+$additional_days;
        $emp_basic = ($a/$max)*$worked_days;
        $emp_basic = number_format((float)$emp_basic, 2, '.', '');
        $emp_DA = ($b/$max)*$worked_days;
        $emp_DA = number_format((float)$emp_DA, 2, '.', '');
        $emp_HRA = ($c/$max)*$worked_days;
        $emp_HRA = number_format((float)$emp_HRA, 2, '.', '');
        $empr_esi = (($emp_basic+$emp_DA+$emp_HRA)*$empr_esic);
        $empr_esi = number_format((float)$empr_esi, 2, '.', '');
        $emp_esi = (($emp_basic+$emp_DA+$emp_HRA)*$emp_esic);
        $emp_esi = number_format((float)$emp_esi, 2, '.', '');
        $empr_pf = (($emp_basic+$emp_DA)*$empr_pfc);
        $empr_pf = number_format((float)$empr_pf, 2, '.', '');
        $emp_pf = (($emp_basic+$emp_DA)*$emp_pfc);
        $emp_pf = number_format((float)$emp_pf, 2, '.', '');
        $OTsal = $_POST["otamt"];
        $advance = $_POST["advamt"];
        $gross = $emp_basic+$emp_DA+$emp_HRA+$empr_esi+$emp_esi+$empr_pf+$emp_pf;
        $deduction = $emp_esi+$emp_pf+$advance;
        $net = $gross-$deduction+$OTsal;
        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT into emp_salary values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "issdddddddddddd", $_SESSION["empid"], $_SESSION["sal_mon"], $_SESSION["sal_yr"], $emp_basic, $emp_DA, $emp_HRA, $OTsal, $advance, $emp_pf, $empr_pf, $emp_esi, $empr_esi, $gross, $deduction, $net);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        leave($conn, $_SESSION["empid"],$_SESSION["sal_mon"], $_SESSION["sal_yr"],$max,$present);
        session_unset();
        {echo '<script type="text/javascript">
            window.onload = function () { alert("Salary calculated successfully"); } 
            </script>';} 
        header("location: wages.php");
    }
    else{
        $worked_days = $present;
        $emp_basic = ($a/$max)*$worked_days;
        $empr_basic = number_format((float)$empr_basic, 2, '.', '');
        $emp_DA = ($b/$max)*$worked_days;
        $empr_DA = number_format((float)$empr_DA, 2, '.', '');
        $emp_HRA = ($c/$max)*$worked_days;
        $empr_HRA = number_format((float)$empr_HRA, 2, '.', '');
        $empr_esi = number_format((float)$empr_esi, 2, '.', '');
        $emp_esi = (($a+$b+$c)*$emp_esic);
        $emp_esi = number_format((float)$emp_esi, 2, '.', '');
        $empr_pf = (($a+$b)*$empr_pfc);
        $empr_pf = number_format((float)$empr_pf, 2, '.', '');
        $emp_pf = (($a+$b)*$emp_pfc);
        $emp_pf = number_format((float)$emp_pf, 2, '.', '');
        $OTsal = 0;
        $advance = 0;
        $gross = $a+$b+$c+$empr_esi+$emp_esi+$empr_pf+$emp_pf+$OTsal;
        $deduction = $empr_esi+$emp_esi+$empr_pf+$emp_pf+$advance;
        $net = $gross-$deduction;
        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT into emp_salary values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "issdddddddddddd", $_SESSION["empid"], $_SESSION["sal_mon"], $_SESSION["sal_yr"], $emp_basic, $emp_DA, $emp_HRA, $OTsal, $advance, $emp_pf, $empr_pf, $emp_esi, $empr_esi, $gross, $deduction, $net);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        leave($conn, $_SESSION["empid"],$_SESSION["sal_mon"], $_SESSION["sal_yr"],$max,$present);
        session_unset();
        {echo '<script type="text/javascript">
            window.onload = function () { alert("Salary calculated successfully"); } 
            </script>';} 
        header("location: wages.php");
    }
}


function getbasic($conn, $emplyid){
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT empbasic from emp_salary_struct where empid=?;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["empid"]);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $sal = mysqli_fetch_assoc($res);
    $basic = $sal["empbasic"];
    return $basic;
}

function getDA($conn, $emplyid){
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT empda from emp_salary_struct where empid=?;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["empid"]);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $sal = mysqli_fetch_assoc($res);
    $da = $sal["empda"];
    return $da;
}

function gethra($conn, $emplyid){
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT emphra from emp_salary_struct where empid=?;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["empid"]);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $sal = mysqli_fetch_assoc($res);
    $hra = $sal["emphra"];
    return $hra;
}

function leave($conn, $empid, $month, $year, $maxdays, $present){
    $totalabsent = $maxdays-$present;
    if($totalabsent<=4){
        $weekoffavailed = $totalabsent;
        $otherleave = 0;
    }
    else{
        $weekoffavailed = 4;
        $otherleave = $maxdays-$present-4;
    }
    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT into emp_leave values (?,?,?,?,?,?,?);";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "issiiii", $_SESSION["empid"], $_SESSION["sal_mon"], $_SESSION["sal_yr"], $maxdays, $present, $weekoffavailed,$otherleave);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
}