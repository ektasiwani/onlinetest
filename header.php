<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" /> 
    <title>
        QOS test your skills
    </title>
	
  <?php include ("core.php");?> 
  <link rel="stylesheet" type="text/css" href="header_files/main.css" />
   <link rel="stylesheet" type="text/css" href="header_files/rps.css" />
  <script language="javascript" src="header_files/menu.js"></script>
  <h1 style="background-color:#64B9B2; width:1366px; height:60px; margin-left:0;">
<?php
if(!loggedin()){
echo '<a class="log" href="logform.php">&nbsp&nbsp;login</a>';}
else{
echo '<a class="log" href="logout.php">&nbsp&nbsp;logout</a>';
}?>
<a class="reg" href="register.php">Register&nbsp;</a>
<nav id="top-menu">
<ul><table class="navbar" cellspacing="2px";>
 <li><a class="specialeffects" href="index.php"><i>Home</i></a></li>
  <li><a class="specialeffects" href="topper.php"><i>Toppers</i></a></li>
 <li><a class="specialeffects" href="check.php"><i>Score&nbsp;</i></a></li>

</ul></table>
</nav>
</h1>
<header>
<style>	
body {
background-color:#F0F8FF;  
}
</style>

</header>