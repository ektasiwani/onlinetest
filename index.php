<?php
include("header.php");?>
<?php
$msg="";
if(isset($_GET['msg'])){
$msg1=$_GET['msg'];
$msg= mysql_real_escape_string(trim($msg1));
$msg=strip_tags($msg);
$msg= addslashes($msg);
}
?>
<! DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Quize test</title>
<script>
function startQuiz(url){
 window.location = url;
 }
 </script>
 </head>

 <body>
  <div id="maindiv" style="height: 540px;">
  <br>
 <?php echo $msg ; 
 if(loggedin())
 {?>
 <br><br>
 <img src="header_files/images1.jpg" width="400px" height="200px" style="margin-left:30px;">
 <h3 style="font-size:100%;"><br><br><br> Click below when you are ready to start the quiz</h3><br>
 <button style="margin-left:25px;"  onClick="startQuiz('quiz.php?question=1')">Attempt</button>
 <br>
 <?php
 }elseif(!loggedin()) { 
 echo ' <br><br>&nbsp&nbsp&nbsp&nbsp<img src="header_files/images.jpg" width="400px" height="200px">';
 echo ' <br><br><br>&nbsp&nbsp&nbsp&nbspPlease login first to take the test..<br><br>' ;
 echo  " &nbsp&nbsp&nbsp&nbspFirst time user please register yourself to take test..";}
 ?>
 </div>
 </body>
 </html>
 <?php include ("footer.php"); ?>