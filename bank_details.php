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
    <title>Bank Details</title>
    <link rel="stylesheet" href="bank.css">
</head>
<body>
    
    <form action = "db_enroll.php" method = "post">
    <img src="image1.png" class="backgroundimage">
    <h2>BANK DETAILS</h2>
    <div class="vith">
        <label class="name"><B>BANK NAME:</B></label><input type="text" placeholder="BANK NAME" id="emp1" class="namei" name = "bankname" value =  "<?php if(isset($_POST["ENROLL"])) {echo $_POST['bankname'];}?>" >
    </B><br><br>

        <label class="ifsc"><B>IFSC CODE:</B> </label><B><input type="text" placeholder="IFSC Code" id="name1" class="ifsci" name = "ifsc" value =  "<?php if(isset($_POST["ENROLL"])) {echo $_POST['ifsc'];}?>"></B><br><br>
        <label class="beni"><B>BENIFICIARY NAME:</B></label><input type="text" placeholder="  Benificiary Name" id="roll1" class="benii" name = "benname" value =  "<?php if(isset($_POST["ENROLL"])) {echo $_POST['benname'];}?>"> <br><br>
        <label class="acc"><B>ACCOUNT NUMBER:</B> </label><input type="number" placeholder="Acc Number" id="wor1" class="acci" name = "accnum" value =  "<?php if(isset($_POST["ENROLL"])) {echo $_POST['accnum'];}?>"><br><br>
        <label class="acc_ty"><B>ACCOUNT TYPE:</B></label><input type="text" placeholder="Acc Type" id="r3" class="acc_tyi" name = "acctype" value =  "<?php if(isset($_POST["ENROLL"])) {echo $_POST['acctype'];}?>"> <br><br>
        <label  class="branch"><B>BRANCH NAME:</B> </label><input type="text" placeholder="Branch Name" id="wo2" class="branchi" name = "branchname" value =  "<?php if(isset($_POST["ENROLL"])) {echo $_POST['branchname'];}?>"><br><br>
        <button type = "submit" class="but1" name = "ENROLL"><b>ENROLL</b></button><br><br>           
           
    </div>  
    </div> 
</body>
</html>
