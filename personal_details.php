<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERSONAL_DETAILS</title>
    <link href="personal_details.css" rel="stylesheet">
</head>
<body>
<form action="" method="post">
    <h2>PERSONAL DETAILS</h2>
    <img src="image1.png" class = "backgroundimage"><br>
    <div>
    <label ><b>NAME  :</b></label>
    <input type="text" placeholder="NAME" class="name" name = "name" value = "<?php if(isset($_POST["personal_details"])) {echo $_POST['name'];}?>">
    <label ><b>DOOR NUMBER :</b></label>
    <input type="text" placeholder="DOOR NO" class="door" name = "d_no" value = "<?php if(isset($_POST["personal_details"])) {echo $_POST['d_no'];}?>"><br><br><br>

    <label><b>DATE OF BIRTH  :</b></label>
    <input type="date" placeholder="DOB" class="dob" name  = "dob" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['dob'];}?>">
    <label ><b>STREET :</b></label>
    <input type="text" placeholder="STREET" class="street" name = "street" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['street'];}?>"><br><br><br>

    <label><b>GENDER  :</b></label>
    <select name="gender"class="gender" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['gender'];}?>">
        <option value="SELECT">SELECT</option>
        <option value="MALE">MALE</option>
        <option value="FEMALE">FEMALE</option>
        <option value="OTHERS">OTHERS</option>
    </select name = "bg" id = "bg">
    <label ><b>AREA  :</b></label>
    <select name="area"class="area" name = "area" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['area'];}?>">
        <option value="SELECT">SELECT</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
    </select name  = "area" id = "area"><br><br><br>
    <label><b>EDUCATION  : </b></label>
    <input type="education" placeholder="EDUCATION" class="edu" name = "education" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['education'];}?>">
    <label ><b>DISTRICT :</b></label>
    <input type="text" placeholder="DISTRICT" class="district" name = "district" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['district'];}?>"><br><br><br>
    <label><b>BLOOD GROUP  : </b></label>
    <select name="blood" class="blood" name = "bg" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['bg'];}?>">
        <option value="SELECT">SELECT</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B">B+</option>
        <option value="B-">B-</option>
        <option value="AB">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O">O+</option>
        <option value="O-">O-</option>
    </select>
    <label ><b>PINCODE :</b></label>
    <input type="number" placeholder="PINCODE" class="pincode" name = "pincode" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['pincode'];}?>"><br><br><br>
    <label><b>AADHAR NUMBER : </b></label>
    <input type="number" placeholder="AADHAR" class="aadhar" name = "aadnum" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['aadnum'];}?>">
    <label ><b>STATE :</b></label>
    <input type="text" placeholder="STATE" class="state" name  = "state" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['state'];}?>"><br><br><br>
    <label><b>PAN NUMBER  :</b></label>
    <input type="text" placeholder="PAN" class="pan" name = "pan" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['pan'];}?>">
    <label ><b>MOBILE NUMBER   :</b></label>
    <input type="number" placeholder="MOBILE NO" class="mobile" name = "mobnum" value =  "<?php if(isset($_POST["personal_details"])) {echo $_POST['mobnum'];}?>"><br><br>
    <button type = "submit" id = "per_det"  name = "personal_details"><b>NEXT</b></button>
</div>
</div>
</form>
</body>
</html>

<?php
require_once "db_connection.php";

if(isset($_POST["personal_details"])){
    $emp_Name = $_POST["name"];
    $emp_DOB = $_POST["dob"];
    $emp_Gender = $_POST["gender"];
    $emp_Edu = $_POST["education"];
    $emp_BG = $_POST["blood"];
    $emp_Aadnum = $_POST["aadnum"];
    $emp_PAN = $_POST["pan"];
    $emp_D_no = $_POST["d_no"];
    $emp_Street = $_POST["street"];
    $emp_Area = $_POST["area"];
    $emp_Dist = $_POST["district"];
    $emp_Pincode = $_POST["pincode"];
    $emp_State = $_POST["state"];
    $emp_Mobnum = $_POST["mobnum"];
        if($emp_Name != NULL and $emp_DOB != NULL and $emp_Gender != NULL and $emp_Aadnum != NULL and $emp_PAN != NULL and 
        $emp_D_no != NULL and $emp_Street != NULL and $emp_Area != NULL and $emp_Dist != NULL and $emp_Pincode != NULL and $emp_State !=NUll and $emp_Mobnum != NULL){
            $x = checkpan($conn, $emp_PAN);
            $y = checkaad($conn, $emp_Aadnum);
            if($x== true){
                {echo '<script type="text/javascript">
                    window.onload = function () { alert("PAN number already exist"); } 
                    </script>';}
                }
            if($y == true){
                {echo '<script type="text/javascript">
                    window.onload = function () { alert("Aadhar number already exist"); } 
                    </script>';}
            }
            if($x!= true and $y!=true){
                if(strlen($emp_PAN)==10 and strlen($emp_Aadnum)==12 and strlen($emp_Mobnum)==10 and strlen($emp_Pincode)==6){
                    $_SESSION["emp_name"] = $emp_Name;
                    $_SESSION["emp_dob"] = $emp_DOB;
                    $_SESSION["emp_gender"] = $emp_Gender;
                    $_SESSION["emp_edu"] = $emp_Edu;
                    $_SESSION["emp_bg"] = $emp_BG;
                    $_SESSION["emp_aadnum"] = $emp_Aadnum;
                    $_SESSION["emp_pan"] = $emp_PAN;
                    $_SESSION["emp_d_no"] = $emp_D_no;
                    $_SESSION["emp_street"] = $emp_Street;
                    $_SESSION["emp_area"] = $emp_Area;
                    $_SESSION["emp_district"] = $emp_Dist;
                    $_SESSION["emp_pincode"] = $emp_Pincode;
                    $_SESSION["emp_state"] = $emp_State;
                    $_SESSION["emp_mobnum"] = $emp_Mobnum;
                    header("location: family_details.php");
                    }

                else{
                    {echo '<script type="text/javascript">
                        window.onload = function () { alert("Enter valid Mobile num or PAN number or aad num or pincode"); } 
                        </script>';} 
                    }
                }
            else{
                {echo '<script type="text/javascript">
                    window.onload = function () { alert("Aadhar number or PAN already exist"); } 
                    </script>';}
            }
            }

        else{
            {echo '<script type="text/javascript">
                window.onload = function () { alert("Enter All mandatory details"); } 
                </script>';} 
        }
    }

//Check whether entered Aadhar number already exists//    

function checkaad($conn, $aadnum){
    $sql="SELECT empaadhaar from emp_personal_details WHERE empaadhaar=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$aadnum);
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

//Check whether entered PAN number already exists//

function checkpan($conn, $pan){
    $sql="SELECT emppan from emp_personal_details WHERE emppan=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$pan);
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