<?php

include "./conn.php";

if(isset($_POST['register'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);

    $s = " SELECT * FROM `login` WHERE `email` = '$email' AND `password`= '$pass' ";
    $select = mysqli_query($conn,$s) or die('query failed');

    if(mysqli_num_rows($select) >0){
        $msg = 'User Account Already Exists!';
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('$msg');
            window.location.href='../register.php';
            </script>");
    }
    else{
        if($pass == $cpass){
            $i = " INSERT INTO `login`( `username`, `password`, `email`) VALUES ('$username','$pass','$email')";
            $insert = mysqli_query($conn,$i);
            $msg = "Register Successfully!!!";
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('$msg');
            window.location.href='../index.php';
            </script>");
        }
        else{
            $msg = "Passwords do not match!";
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('$msg');
            window.location.href='../register.php';
            </script>");
        }
    }

}
?>