<?php
session_start();
require_once "connection.php";

if(isset($_POST["P"])){
    $form = "P_FORM";
    $_SESSION["req_form"] = $form;
    header("location: FormP.php");
}

if(isset($_POST["R"])){
    $form = "R_FORM";
    $_SESSION["req_form"] = $form;
    header("location: FormR.php");
}
if(isset($_POST["S"])){
    $form = "S_FORM";
    $_SESSION["req_form"] = $form;
    header("location: Form_S.php");
}

if(isset($_POST["OT"])){
    $form = "OT_FORM";
    $_SESSION["req_form"] = $form;
    header("location: FormOT.php");
}