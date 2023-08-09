<?php
session_start();
require_once "connection.php";

if(isset($_POST["ENROLL"])){
    $emp_Bankname = $_POST["bankname"];
    $emp_Ifsc = $_POST["ifsc"];
    $emp_Benname = $_POST["benname"];
    $emp_Accnum = $_POST["accnum"];
    $emp_Acctype = $_POST["acctype"];
    $emp_Branchname = $_POST["branchname"];
    if($emp_Ifsc != NULL and $emp_Bankname!= NULL and $emp_Accnum != NULL and $emp_Accnum != NULL){
        $_SESSION["emp_bankname"] = $emp_Bankname;
        $_SESSION["emp_ifsc"] = $emp_Ifsc;
        $_SESSION["emp_benname"] = $emp_Benname;
        $_SESSION["emp_accnum"] = $emp_Accnum;
        $_SESSION["emp_acctype"] = $emp_Acctype;
        $_SESSION["emp_bname"] = $emp_Branchname;
        insert_per_det($conn);
        insert_fam_det($conn);
        insert_exp_det($conn);
        insert_sal_strct_det($conn);
        insert_bank_det($conn); 
        session_unset();
    }
    else{
        {echo '<script type="text/javascript">
        window.onload = function () { alert("Mandatory fields are required"); } 
        </script>';} 
    }
}

function insert_per_det($conn){
    $stmt = mysqli_stmt_init($conn);
    $state= $_SESSION["emp_d_no"].$_SESSION["emp_street"];
    $sql="INSERT into emp_personal_details(empname, empdob, empgender, empbg, emppan, empaadhaar, empaddr, emparea, empstate, empdist, emppincode, empmobnum) values(?,?,?,?,?,?,?,?,?,?,?,?);";
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ssssssssssis",$_SESSION["emp_name"], $_SESSION["emp_dob"], $_SESSION["emp_gender"], $_SESSION["emp_bg"], $_SESSION["emp_pan"], $_SESSION["emp_aadnum"], $state, $_SESSION["emp_area"], $_SESSION["emp_state"], $_SESSION["emp_district"], $_SESSION["emp_pincode"], $_SESSION["emp_mobnum"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function insert_fam_det($conn){
    $sql = "INSERT INTO emp_family(empmarstat, empfname, empmname, emppname, empccount, empemecon) values (?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt,"ssssis", $_SESSION["emp_marstat"], $_SESSION["emp_fname"],$_SESSION["emp_mname"],$_SESSION["emp_sname"] ,$_SESSION["emp_ccount"],$_SESSION["emp_emecon"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
}

function insert_exp_det($conn){
    $stmt = mysqli_stmt_init($conn);
    $sql="INSERT into emp_exp (empwexp, emporg, empexp, emprole, empprevsal, empuan, empesi) values(?,?,?,?,?,?,?);";
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ssissss",$_SESSION["emp_exp"], $_SESSION["emp_org"], $_SESSION["emp_exper"], $_SESSION["emp_role"], $_SESSION["emp_sal"], $_SESSION["emp_uan"], $_SESSION["emp_esi"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function insert_sal_strct_det($conn){
    $stmt = mysqli_stmt_init($conn);
    $sql="INSERT into emp_salary_struct (emprole, empbasic, emphra, empda, empbaopt, empbaall, empwh, empintime, empouttime, empdoj) values(?,?,?,?,?,?,?,?,?,?);";
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"siiisissss",$_SESSION["emp_role"], $_SESSION["emp_basic"], $_SESSION["emp_hra"], $_SESSION["emp_da"], $_SESSION["emp_baopt"], $_SESSION["emp_baall"],  $_SESSION["emp_wh"], $_SESSION["emp_intime"], $_SESSION["emp_outtime"], $_SESSION["emp_doj"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);   
}

function insert_bank_det($conn){
    $stmt = mysqli_stmt_init($conn);
    $sql="INSERT into emp_bank (empbankname, empifsc, empaccnum, empacctype, empbenname, empbankbranch) values(?,?,?,?,?,?);";
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ssssss",$_SESSION["emp_bankname"], $_SESSION["emp_ifsc"], $_SESSION["emp_accnum"], $_SESSION["emp_acctype"], $_SESSION["emp_benname"], $_SESSION["emp_bname"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    session_unset();
    {echo '<script type="text/javascript">
        window.onload = function () { alert("Registration successfully completed"); } 
        </script>';} 
        header("location: empid.php");
}
?>