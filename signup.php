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
    <title>SIGNUP</title>
    <link href="signup.css" rel="stylesheet" >
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action = "" method = "post">
                <img src="image1.png" class = "backgroundimage">
               <br><br><br><h1>Sign up</h1>
                <input type="text" placeholder="Name" name  = "username" value =  "<?php if(isset($_POST["signup"])) {echo $_POST['username'];}?>">
                <input type="email" placeholder="email" name = "mailid" value =  "<?php if(isset($_POST["signup"])) {echo $_POST['mailid'];}?>">
                <input type="password" placeholder="password" name = "pwd">
                <input type="password" placeholder="confirm password" name = "pwd1">
                <button type = "submit" name = "signup">Sign Up</button>
                <button type = "submit" name = "signin">Sign In</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action = "" method = "post">
                <img src="image1.png" class = "backgroundimage">
                <h1>Sign In</h1>
                <input type="email" placeholder="Email" name = "email"/>
                <input type="password" placeholder="password" name = "pswd"/>
                <button>Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
require_once  "connection.php";

if(isset($_POST["signup"])){
    $username = $_POST["username"];
    $mailid = $_POST["mailid"] ;
    $pwd = $_POST["pwd"];
    $pwd1 = $_POST["pwd1"];

    //Check if any field remain unfilled
    if($pwd == NULL or $pwd1 == NULL or $mailid == NULL or $username == NULL){
        {echo '<script type="text/javascript">
             alert("Please enter all details");  
            </script>';} 
    }

    //checks length of the password
    if(strlen($pwd)<8 and $mailid!=NULL){
        {echo '<script type="text/javascript">
            window.onload = function () { alert("Password must contain more than 8 character"); } 
            </script>';} 
    }

    //checks if both passsword matched
    if($pwd1!=$pwd){
        {echo '<script type="text/javascript">
            window.onload = function () { alert("Password does\'t match"); } 
            </script>';} 
    }
    
    $y = checkmailid($conn, $mailid);

    if($y==true){
        {echo '<script type="text/javascript">
            window.onload = function () { alert("Mailid already exist use new mail"); } 
            </script>';} 
    }
    if($pwd1==$pwd and $y == false and strlen($pwd)>=8){
        registeruser($conn, $username, $pwd, $mailid);
        {echo '<script type="text/javascript">
            window.onload = function () { alert("Registration successfull"); } 
            </script>';} 

    }
}


//Redirect to signin page
if(isset($_POST["signin"])){
    header("location: signin.php");
}

?>

<?php

//Importing the connection module

require_once "db_connection.php";

//Function to check if user mail already exist

function checkmailid($conn, $mailid){
    $sql="SELECT emailid from login_details WHERE emailid=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$mailid);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $rs=mysqli_fetch_assoc($result);
    if($rs){
        return true; 
    }
    return false;
    $abc=$rs["emailid"];
    echo $abc;
    exit();
}

//Function to push user details to DB

function registeruser($conn, $username, $b, $c){
    $sql = "INSERT INTO login_details values (?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt,"sss", $username, $c, $b);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


?>