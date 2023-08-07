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
    <title>SIGNIN</title>
    <link href="signin.css" rel="stylesheet" >
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action = "" method = "post">
                <img src="image1.png" class = "backgroundimage">
                <h1>Sign In</h1>
                <input type="email" placeholder="email" name = "email">
                <input type="password" placeholder="password" name = "password">
                <button type = "submit" name = "signin">Sign In</button><br>
                New user!
                <button type = "submit" name = "signup">Register</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form>
                <img src="image1.png" class = "backgroundimage">
                <h1>Sign In</h1>
                <input type="email" placeholder="Email">
                <input type="password" placeholder="password">
                <button type = "submit" name = "signin">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
//Importing the connection module

require_once "db_connection.php";

//Function runs once we click submit button to pass user input

if(isset($_POST["signin"])){
    $username = $_POST["email"];
    $pwd = $_POST["password"];
    if($username != NULL and $pwd != NULL){
        $x=login($conn,$username,$pwd);
        if($x==true){
            $_SESSION["un"] = $username;
            $_SESSION["p"] = $pwd; 
            header("location: initial_page.php");
        }
        else{
            {echo '<script type="text/javascript">
            window.onload = function () { alert("Enter valid credential"); } 
            </script>';} 
        }
        }
    else{
        {echo '<script type="text/javascript">
            window.onload = function () { alert("Enter valid UserID and Password"); } 
            </script>';} 
    }
    }

//Redirect to signup page for new user

if(isset($_POST["signup"])){
    header("location: signup.php");
}

//Funtion to fetch and validate user details from DB

function login($conn,$username,$pwd){
    $sql="SELECT emailid from login_details WHERE BINARY emailid=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s", $username);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $rs=mysqli_fetch_assoc($result);
    if($rs){
        $sql="SELECT passwd from login_details WHERE BINARY emailid=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s", $username);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $rs=mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        $password=$rs["passwd"];
        if($pwd==$password){
            return true;
        }
        return false;
        exit();
    }
    else{
        {echo '<script type="text/javascript">
        window.onload = function () { alert("Wrong username"); } 
        </script>';} 
    }
}
?>