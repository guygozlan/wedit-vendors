<!DOCTYPE html>

<?php
// TODO: Login proccess
session_start();
$error='';
  if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
      $error = "Username or Password is invalid";
    }
    else
    {
      $username=$_POST['username'];
      $password=$_POST['password'];
      if ('guy150383' == $password)
      {
        $_SESSION['login_user']=$username;
        header("location: home.php");
      } else {
        $error = "Username or Password is invalid";
      }
    }
  }
?>
