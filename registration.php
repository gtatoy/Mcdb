<?php
require_once('config.php');
$fname = $lname = $gender = $email = $password = $pwd = '';

$fname = $_POST['Firstname'];
$lname - $_POST['Lastname'];
$gender = $_POST['Gender'];
$email = $_POST['Email'];
$pwd = $_POST['Password'];
$password = MD5($pwd);

$sql = "INSERT INTO user (Firstname,Lastname,Gender,Email,Password)
  VALUES ('$fname','$lname','$gender','$email','$password')";

$result = mysqli_query($conn, $sql);
if($result)
{
  header("Location: login.php");
}
else
{
  echo "Error :".$sql;
}
 ?>
