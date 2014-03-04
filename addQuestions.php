<?php
if(isset($_POST['desc'])){
if(!isset($_POST['iscorrect']) || $_POST['iscorrect'] == ""){
echo "Sorry, important data missing,please press back and continue. ";
exit();
}if(!isset($_POST['type']) || $_POST['type'] == "" ){
echo "Sorry,there was an error passing the form.please try again.";
exit();
}
require_once("conect.php");
$question1 = $_POST['desc'];
$question= mysql_real_escape_string(trim($question1));
$answer1=$_POST['answer1'];
$answer2=$_POST['answer2'];
$answer3=$_POST['answer3'];
$answer4=$_POST['answer4'];
$type1=$_POST['type'];
$type= mysql_real_escape_string(trim($type1));
$type=preg_replace('/[^a-z]/', "", $type);
$isCorrect = preg_replace('/[^0-9a-z]/', "", $_POST['iscorrect']);
$answer1= strip_tags($answer1);
$answer1=mysql_real_escape_string($answer1);
$answer1= strip_tags($answer1);
$answer2=mysql_real_escape_string($answer2);
$answer2= strip_tags($answer2);
$answer3=mysql_real_escape_string($answer3);
$answer3= strip_tags($answer3);
$answer4=mysql_real_escape_string($answer4);
$answer4= strip_tags($answer4);
$question=mysql_real_escape_string($question);
$question= strip_tags($question);
if($type== 'tf'){
if((!$question) || (!$answer1) || (!$answer2) || (!$isCorrect)){
echo 'Sorry,All field must be field.';
exit();
}
}
if($type == 'mc'){
if((!$question) || (!$answer1) || (!$answer2) || (!$answer3) || (!$answer4) || (!$isCorrect)){
echo 'Sorry,All field must be field.';
exit();
}
}
$sql = mysql_query("INSERT INTO questions (question,type) VALUES ('".$question."','".$type."')") or die (mysql_error());
$lastId = mysql_insert_id();
mysql_query("UPDATE questions SET question_id='$lastId' WHERE id='$lastId' LIMIT 1") or die (mysql_error());
if($type == 'tf'){
if($isCorrect == "answer1"){
$sql2 = mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer1','1')");
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer2','0')") or die(mysql_error());
$msg='Thanks,your question has been added';
header('location:addQuestions.php?msg='.$msg.'');
exit();
}
if($isCorrect == "answer2"){
$sql2 = mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer2','1')");
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer1','0')") or die(mysql_error());
$msg='Thanks,your question has been added';
header('location:addQuestions.php?msg='.$msg.'');
exit();}
}
if($type == 'mc'){
if($isCorrect == "answer1"){
$sql2= mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer1','1')");
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer2','0')") or die(mysql_error());
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer3','0')") or die(mysql_error());
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer4','0')") or die(mysql_error());
$msg = 'Thanks,your question has been added';
header('location:addQuestions.php?msg='.$msg.'');
exit();}
if($isCorrect == "answer2"){
$sql2= mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer2','1')");
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer1','0')") or die(mysql_error());
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer3','0')") or die(mysql_error());
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer4','0')") or die(mysql_error());
$msg = 'Thanks,your question has been added';
header('location:addQuestions.php?msg='.$msg.'');
exit();}
if($isCorrect == "answer3"){
$sql2= mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer3','1')");
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer1','0')") or die(mysql_error());
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer2','0')") or die(mysql_error());
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer4','0')") or die(mysql_error());
$msg = 'Thanks,your question has been added';
header('location:addQuestions.php?msg='.$msg.'');
exit();}
if($isCorrect == "answer4"){
$sql2= mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer4','1')");
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer1','0')") or die(mysql_error());
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer2','0')") or die(mysql_error());
mysql_query("INSERT INTO answers (question_id,answer,correct) VALUES ('$lastId','$answer3','0')") or die(mysql_error());
$msg = 'Thanks,your question has been added';
header('location:addQuestions.php?msg='.$msg.'');
exit();}
}
}
?>
<?php
$msg="";
if(isset($_GET['msg'])){
$msg= $_GET['msg'];
$msg= mysql_real_escape_string(trim($msg));
}?>
<?php
//for deleting question.
if(isset($_POST['reset'])&& $_POST['reset'] != ""){
$reset = preg_replace('/^[a-z]/',"",$_POST['reset']);
require_once("conect.php");
mysql_query("TRUNCATE TABLE questions") or die(mysql_error());
mysql_query("TRUNCATE TABLE answers") or die(mysql_error());
//check if delete or not.
$sql1= mysql_query("SELECT id FROM questions LIMIT 1") or die(mysql_error());
$sql2= mysql_query("SELECT id FROM answers LIMIT 1") or die(mysql_error());
$numQuestions=mysql_num_rows($sql1);
$numAnswers=mysql_num_rows($sql2);//if result is greater then 0 then not delete.
if($numQuestions > 0 || $numAnswers > 0){
echo "Sorry, there was a problem reseting the quiz. Please try again later.";
exit();
}else{
echo "Thanks! The quiz has now been reset back to 0 questions.";}
exit();
}

?>
<! DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Create Quize</title>
<script>
function showDiv(el1,el2){
document.getElementById(el1).style.display = 'block';
document.getElementById(el2).style.display = 'none';
}
</script>
<script>
function resetQuiz(){
 var x = new XMLHttpRequest();
 var url = "addQuestions.php";
 var vars='reset=yes';
 x.open("POST",url,true);
 x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 x.onreadystatechange=function(){
 if(x.readyState==4 && x.status==200){
 document.getElementById("resetBtn").innerHTML= x.responseText;}
 }
 x.send(vars);
 document.getElementById("resetBtn").innerHTML= "processing..."
 }
 </script>
<style>
.content{
margin-top:48px;
margin-left:auto;
margin-right:auto;
width:780px;
border:#333 1px solid;
border-radius:12px;
-moz-border-radius:12px;
padding:12px;
display:none;
}</style>
</head>
<body>
<div style="width:700px; margin-left:auto;margin-right:auto;text-align:center;">
<p style="color:red;"><?php echo $msg; ?></p>
<h2>What type of quiz you want to create?</h2>
<button onClick="showDiv('tf','mc')">True/False</button>&nbsp;&nbsp;<button onClick="showDiv('mc','tf')">Multiple choice</button>&nbsp;&nbsp;
<span id="resetBtn"><button onclick="resetQuiz()">Reset quiz to zero</button></span>
</div>
<div class="content" id="tf">
<h3> True or False</h3>
<form action="addQuestions.php" name="addQuestion" method="post">
<strong>type question</strong>
</br>
<textarea id="tfDesc" name="desc" style="width:400px; height:95;"></textarea>
</br>
<strong>select true or false</strong>
</br>
<input type="text" id="answer1" name="answer1" value="True" readonly>&nbsp;
<label style="cursor:pointer; color:#06F;">
<input type="radio" name="iscorrect" value="answer1">Correct Answer?</label>
</br></br>
<strong>Please create the second answer for question</strong>
</br><input type="text" id="answer2" name="answer2" value="False" readonly>&nbsp;
<label style="cursor:pointer; color:#06F;">
<input type="radio" name="iscorrect" value="answer2">Correct Answer?</label>
</br></br>
<input type="hidden" value="tf" name="type">
<input type="submit" value="Add to Quiz">
</form>
</div>
<div class="content" id="mc">
<h3>Multiple Choice</h3>
<form action="addQuestions.php" name="addMcQuestion" method="post">
<strong>Type Question</strong>
</br>
<textarea id="mcDesc" name="desc" style="width:400px; height:95;"></textarea>
</br>
<strong>Create first answer</strong>
</br>
<input type="text" id="mcanswer1" name="answer1">&nbsp;
<label style="cursor:pointer; color:#06F;">
<input type="radio" name="iscorrect" value="answer1">Correct Answer?</label>
</br></br>
<strong>Create second answer</strong>
</br>
<input type="text" id="mcanswer2" name="answer2">&nbsp;
<label style="cursor:pointer; color:#06F;">
<input type="radio" name="iscorrect" value="answer2">Correct Answer?</label>
</br></br>
<strong>Create third answer</strong>
</br>
<input type="text" id="mcanswer3" name="answer3">&nbsp;
<label style="cursor:pointer; color:#06F;">
<input type="radio" name="iscorrect" value="answer3">Correct Answer?</label>
</br></br>
<strong>Create fourth answer</strong>
</br>
<input type="text" id="mcanswer4" name="answer4">&nbsp;
<label style="cursor:pointer; color:#06F;">
<input type="radio" name="iscorrect" value="answer4">Correct Answer?</label>
</br></br>
<input type="hidden" value="mc" name="type">
<input type="submit" value="Add to Quiz">
</form></div>
</body>
</html>