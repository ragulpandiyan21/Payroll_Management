<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM GENERATION</title>
    <link rel="stylesheet" href="form_period_sel.css">
</head>
<body>
    <img src="image1.png" class="backgroundimage">
    <form action = "" method = "post">
    <div class="container">
       <br> <label><b>START DATE</b></label>

        <select name="startmonth" class="area">
        <option>Month</option>
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
        </select>
        
        <select name="startyear"class="area">
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
        </select><br>
    <div class="buttons">

        <button type = submit class="btn" name = "view"><b>VIEW</b></button><br>
    </div>
</form>
</body>
</html>

<?php
session_start();
require_once "db_connection.php";

if(isset($_POST["view"])){
    $start_month = $_POST["startmonth"];
    $start_year = $_POST["startyear"];
    $_SESSION["mth"] = $start_month;
    $_SESSION["yr"] = $start_year;
    header("location: forms.php");
}