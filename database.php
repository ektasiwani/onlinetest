<?php
$con=mysqli_connect("localhost","root","q1w2e3");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create database
$sql="CREATE DATABASE QOS";
if (mysqli_query($con,$sql))
  {
  echo "Database QOS created successfully";
  }
else
  {
  echo "Error creating database: " . mysqli_error($con);
  }
?> 
