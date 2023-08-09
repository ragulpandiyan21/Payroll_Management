<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management</title>
    <link rel="stylesheet" href="initial_page.css">
</head>
<body>
    <div class="logo">
        <form action="db-select_act.php" method="post">
        <img src="image1.png"><br><br>
            <button name = "Payroll"><b>PAYROLL GENERATION</b></button><br>
            <button name = "Registration"><b>EMPOLYEE REGISTRATION</b></button>
        </form>
    </div>
</body>
</html>

<?php
session_start();

if(isset($_POST["Payroll"])){
    header("location: payroll_selection.php");
}
if(isset($_POST["Registration"])){
    header("location: personal_details.php");
}

?>