<?php
session_start();
error_reporting(E_ERROR  | E_PARSE);
// Create connection
$conn = new mysqli("localhost","root","","popup");
$conn->query("set names utf8");


// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


  if(!empty($_SESSION['cus_id'])){
  	$cus_id = $_SESSION['cus_id'];
  	$sql = "select * from cus where cus_id ='". $cus_id ."'";
  	$query = $conn->query($sql);
  	$row = $query->fetch_assoc();
  	$_SESSION['wallet'] = $row['wallet'];
  }