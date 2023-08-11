<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYROLL</title>
    <link rel="stylesheet" href="payroll_selection.css">
</head>
<body>
<form action="" method="post">
    <img src="image1.png" class = "backgroundimage"><br>
    <div>
        <button name = "salcal"><b>SALARY CALCULATION</b></button><br>
        <button name = "formgen"><b>FORM GENERATION</b></button>
    </div>
</form>
</body>
</html>

<?php
session_start();
require_once "db_connection.php";

if(isset($_POST["salcal"])){
    header("location: wages.php");
}
if(isset($_POST["formgen"])){
    header("location: form_period_sel.php");
}

?>