<?php include("header.php"); ?>
<?php
if(isset($_POST['radio']) && $_POST['radio'] != ""){
$answer = preg_replace('/[^0-9]/'," ", $_POST['radio']);
if(!isset($_SESSION['answer_array']) || count($_SESSION['answer_array']) < 1){
$_SESSION['answer_array']= array($answer);
}else{
array_push($_SESSION['answer_array'], $answer);
} 
}
if(isset($_POST['qid']) && $_POST['qid'] != ""){
$qid = preg_replace('/[^0-9]/', " `", $_POST['qid']);
if(!isset($_SESSION['q id_array']) || count($_SESSION['qid_array']) < 1){
$_SESSION['qid_array']=array($qid);
}else{
array_push($_SESSION['qid_array'],$qid);
}
$_SESSION['lastQuestion']=$qid;
}
?>
<?php
require_once("conect.php");
$response = "";
if(!isset($_SESSION['answer_array']) || count($_SESSION['answer_array'])<1){
$response = "You have not answer any question yet";
?><div id="maindiv">
<div style="margin-left:20px;">
<br>
<?php
echo $response; ?>
<br><br></div></div>
<?php include("footer.php"); ?>
<?php
exit();
}else
{$countCheck = mysql_query("SELECT id FROM questions") or die(mysql_error());
$count = mysql_num_rows($countCheck);
$numCorrect = 0;
foreach($_SESSION['answer_array'] as $current){
if($current==1){
$numCorrect++;}
}
$percent = $numCorrect/$count * 100;
$percent = intval($percent);
if(isset($_POST['complete']) && $_POST['complete']== "true"){
if(!isset($_POST['username']) || $_POST['username']==""){?>
<div id="maindiv">
<div style="margin-left:20px;">
<br>
<?php
echo "sorry, we had an error";
?>
<br><br></div></div>
<?php include("footer.php"); ?>
<?php
exit();
}
$username = $_POST['username'];
$username = mysql_real_escape_string($username);
$username = strip_tags($username);
if(!in_array("1",$_SESSION['answer_array'])){
$sql= mysql_query("INSERT INTO quiz_takers (username,percentage,date_time) VALUES ('$username','0',now())") or die(mysql_error());
echo "Your scored % is";
unset($_SESSION['answer_array']);
unset($_SESSION['qid_array']);
session_destroy();
exit();
}
$sql= mysql_query("INSERT INTO quiz_takers (username , percentage,date_time) VALUES ('$username','$percent',now())") or die(mysql_error());
?>
<div  id="maindiv" style="height:540px;">
<div style="margin-left:20px;">
<br>
<?php
echo"Thanks for taking test, your score is $percent%";?>
<br><br>
</div>
</div>
<?php include("footer.php"); ?>
<?php
unset($_SESSION['answer_array']);
unset($_SESSION['qid_array']);
session_destroy();
exit();
}
}
?>
<?php include("footer.php"); ?>