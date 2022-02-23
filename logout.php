<?php
include('../registration/functions.php');
session_destroy();
unset($_SESSION['user']);
header("location: ../registration/signup_and_signin_folder/signin.php");
?>
