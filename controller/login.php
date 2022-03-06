<?php

include "./conn.php";

session_start();

if(isset($_POST['login'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);

   $select = mysqli_query($conn, "SELECT * FROM `login` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      $msg = "Logged in Successfully!!!";
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('$msg');
            window.location.href='../index.php';
            </script>");
   }else{
    $msg = "Incorrect email or password!";
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('$msg');
    window.location.href='../login.php';
    </script>");
   }

}
?>