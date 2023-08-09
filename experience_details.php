<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experience Details</title>
    <link rel="stylesheet" href="experience_details.css">
</head>
<body>
    <h1>EXPERIENCE</h1>
    <br>
    <hr> 
    <br>
    <img src="image1.png" class = "backgroundimage"><br>
    <form action = "" method = "post">
    <div class="radio">
        <label>WORK EXPERIENCE: </label>
    <select name = "exp">
        <option value="select" class="rad">SELECT</option>
        <option value="experienced" class="rad">EXPERIENCED</option>
        <option value="existing"class="rad">EXISTING</option>
        <option value="fresher"class="rad">FRESHER</option>
    </select><br><br><br>
    </div>
    <div class="nith">
    <div class="exp">
        <label>ORGANIZATION: </label><input type="text" placeholder="ORG" class="org" name = "orgn" value = "<?php if(isset($_POST["next"])) {echo $_POST['orgn'];}?>"> (optional)<br><br><br>
        <label>EXPERIENCE: </label><input type="number" placeholder="YEARS" class="expr" name = "exper" value = "<?php if(isset($_POST["next"])) {echo $_POST['exper'];}?>">  (optional)<br><br><br>
        <label>SALARY: </label><input type="number" placeholder="SALARY" class="sal" name="salary" value = "<?php if(isset($_POST["next"])) {echo $_POST['salary'];}?>">  (optional)<br><br><br>
        <label>ROLE: </label><input type="text" placeholder="ROLE" class="rol" name = "role_prev" value = "<?php if(isset($_POST["next"])) {echo $_POST['role_prev'];}?>">  (optional)<br><br><br>
    </div>

    <div class="numbers">
        <label>UAN: </label><input type="number" placeholder="UAN NUMBER" class="una" name="UAN" value = "<?php if(isset($_POST["next"])) {echo $_POST['UAN'];}?>">*<br><br><br>
        <label>ESI: </label><input type="number" placeholder="ESI NUMBER" class="esi" name="ESI" value = "<?php if(isset($_POST["next"])) {echo $_POST['ESI'];}?>">*<br><br><br>
    </div>
    
    <div class="part">
        <a href="#">
            <button type = "submit" id = "nxt" name = "next"><b>NEXT</b></button></a>
    </div>
</div>

</form>
</body>
</html>

<?php
require_once "db_connection.php";

if(isset($_POST["next"])){
    $emp_Exp = $_POST["exp"];
    $emp_Org = $_POST["orgn"];
    $emp_Exper = $_POST["exper"];
    $emp_Sal = $_POST["salary"];
    $emp_Role = $_POST["role_prev"];
    $emp_UAN = $_POST["UAN"];
    $emp_ESI = $_POST["ESI"];
    $x = checkuan($conn, $emp_UAN);
    $y = checkesi($conn, $emp_ESI);
    if($x== true){
        {echo '<script type="text/javascript">
        window.onload = function () { alert("UAN number already exist"); } 
        </script>';}
        }
    if($y == true){
        {echo '<script type="text/javascript">
        window.onload = function () { alert("ESI number already exist"); } 
        </script>';}
        }
    if($x!= true and $y!= true){
        if(($emp_ESI != NULL) and $emp_Exp != NULL and ($emp_UAN != NULL)){
            $_SESSION["emp_exp"] = $emp_Exp;
            $_SESSION["emp_org"] = $emp_Org;
            $_SESSION["emp_exper"] = $emp_Exper;
            $_SESSION["emp_sal"] = $emp_Sal;
            $_SESSION["emp_role"] = $emp_Role;
            $_SESSION["emp_uan"] = $emp_UAN;
            $_SESSION["emp_esi"] = $emp_ESI;
            header("location: salary_details.php");
        }
        else{
            {echo '<script type="text/javascript">
            window.onload = function () { alert("Enter All mandatory details"); } 
            </script>';}
            }
    }
    else{
        {echo '<script type="text/javascript">
            window.onload = function () { alert("UAN or ESI number already exist"); } 
            </script>';}
    }
}

//Checks whether entered UAN number already exists//

function checkuan($conn, $uan){
    $sql="SELECT empuan from emp_exp WHERE empuan=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$uan);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $rs=mysqli_fetch_assoc($result);
    if($rs){
        return true; 
    }
    else{
        return false;
    }
    exit();
}

//Checks whether entered ESI number already exists//

function checkesi($conn, $esi){
    $sql="SELECT empesi from emp_exp WHERE empesi=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$esi);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $rs=mysqli_fetch_assoc($result);
    if($rs){
        return true; 
    }
    else{
        return false;
    }
    exit();
}
?>