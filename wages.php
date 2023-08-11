<?php
session_start();
require_once "db_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALARY</title>
    <link href="wages.css" rel="stylesheet">
</head>
<body>
<div class="container">
<form action = "" method = "post">
    <img src="image1.png" class ="backgroundimage">
    <h2>WAGES</h2>
    <label>MONTH: 
<select class="month" name = "salmonth">
    <option value = "SELECT">Month</option>
    <option value="JAN">JAN</option>
    <option value="FEB">FEB</option>
    <option value="MAR">MAR</option>
    <option value="APR">APR</option>
    <option value="MAY">MAY</option>
    <option value="JUN">JUN</option>
    <option value="JUL">JUL</option>
    <option value="AUG">AUG</option>
    <option value="SEP">SEP</option>
    <option value="OCT">OCT</option>
    <option value="NOV">NOV</option>
    <option value="DEC">DEC</option>
</select></label>
<label>YEAR: 
<select class="year" name = "salyear">
    <option value = "SELECT">Year</option>
    <option value="2022">2022</option>
    <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
    <option value="2026">2026</option>
    <option value="2027">2027</option>
    <option value="2028">2028</option>
    <option value="2029">2029</option>
    <option value="2030">2030</option>
    <option value="2031">2031</option>
    <option value="2032">2032</option>
    <option value="2033">2033</option>
    <option value="2034">2034</option>
    <option value="2035">2035</option>
    <option value="2036">2036</option>
    <option value="2037">2037</option>
    <option value="2038">2038</option>
    <option value="2039">2039</option>
    <option value="2040">2040</option>
    <option value="2041">2041</option>
    <option value="2042">2042</option>
    <option value="2043">2043</option>
    <option value="2044">2044</option>
    <option value="2045">2045</option>
    <option value="2046">2046</option>
</select></label>
<label>EMPLOYEE ID: <input type="number" placeholder="emp_id" class="emp_id" name = "empid"></label><br>
<button type= "submit" name = "ent">ENTER</button>
<button type= "submit" name = "mm">MAIN MENU</button>
</form>
</div>
</body>
</html>



<?php

if(isset($_POST["mm"])){
    header("location: initial_page.php");
}

if(isset($_POST["ent"])){
    $emp_eid = $_POST["empid"];
    $emp_sal_mon = $_POST["salmonth"];
    $emp_sal_year = $_POST["salyear"];
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT empid from emp_personal_details where empid=?;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $emp_eid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rs = mysqli_fetch_assoc($result);
    if($rs){
        $emp_eid = $rs["empid"];
        $_SESSION["empid"] = $emp_eid;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT net_sal from emp_salary where empid=? and salmonth=? and salyear=?;";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $emp_eid, $emp_sal_mon, $emp_sal_year);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $sal = mysqli_fetch_assoc($res);
        if($sal){
            {echo '<script type="text/javascript">
                window.onload = function () { alert("Already salary calculated for this emplyoee"); } 
                </script>';} 
        }
        else{
            $curryear = date("Y");
            $currmon = date("m");
            $selecmon = date("n",strtotime($_POST["salmonth"]));
            if($curryear<$_POST["salyear"]){
                {echo '<script type="text/javascript">
                    window.onload = function () { alert("Please select valid year"); } 
                    </script>';} 
                $a = false;
            }
            if($curryear == $_POST["salyear"]){
                if($currmon<=$selecmon){
                    {echo '<script type="text/javascript">
                        window.onload = function () { alert("Please select valid year"); } 
                        </script>';}
                        $a=false; 
                }
                else{
                    $a = true;
                }
            }
            if($curryear>$_POST["salyear"]){
                $a = true;
            }
            if($a==true){
                $_SESSION["sal_mon"] = $_POST["salmonth"];
                $_SESSION["sal_yr"] = $_POST["salyear"];
                header("location: salary2.php");
            }
        }
    }
    else{
        {echo '<script type="text/javascript">
            window.onload = function () { alert("Employee with given id doesnt exist"); } 
            </script>';} 
    }
}

function getname($conn, $emp_eid){
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT empname from emp_personal_details where empid=?;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $emp_eid);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $sal = mysqli_fetch_assoc($res);
    $name = $rs["empname"];
    return $name;
}
function getrole($conn, $emp_eid){
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT emprole from emp_salary_struct where empid=?;";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $emp_eid);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $sal = mysqli_fetch_assoc($res);
    $role = $rs["emprole"];
    return $role;
}