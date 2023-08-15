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
    <title>EMPLOYEE ID</title>
    <link href="empid.css" rel="stylesheet">
</head>
<body>
    <div class="container" id="container">
        <form action = "" method = "post">
            <img src="image1.png" class = "backgroundimage">
            <label>EMPLOYEE ID: <input type="text" value = "<?php if(isset($_SESSION["emplyid"])) {echo $_SESSION["emplyid"];}?>"> <button type = "submit" name = "empid" >VIEW ID</button></label><br>
            <button type = submit name = newuser>ENROLL NEW USER</button><button type = submit name = home>MAIN MENU</button> <button type = submit name = logout>LOG OUT</button>
        </form>
    </div>
</body>
</html>

<?php
require_once "connection.php";

if(isset($_POST["empid"])){
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT empid from emp_personal_details where empid=(SELECT max(empid) from emp_personal_details);";
    mysqli_stmt_prepare($stmt, $sql);
    //mysqli_stmt_bind_param($stmt,"i", "empid");
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $rs=mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    $empid=$rs["empid"];
    $_SESSION["emplyid"] = $empid;
}

if(isset($_POST["newuser"])){
    header("location: personal_details.php");
}

if(isset($_POST["home"])){
    header("location: initial_page.php");
}

if(isset($_POST["logout"])){
    header("location: signin.php");
}