<?php include("header.php"); ?>
<?php
if(isset($_GET['question'])){
$question1= preg_replace('/[^0-9]/'," ", $_GET['question']);
$question= mysql_real_escape_string(trim($question1));
$next= $question + 1;
$prev= $question -1;

if(isset($_SESSION['qid_array']) && in_array($question,$_SESSION['qid_array'])){
$msg='&nbsp sorry,cheating not allowed,you have to start again.';
unset($_SESSION['answer_array']);
unset($_SESSION['qid_array']);
session_destroy();
header("location: nem.php?msg=$msg");
exit();
}
if(isset($_SESSION['lastQuestion']) && $_SESSION['lastQuestion'] != $prev){
$msg=' &nbsp sorry,cheating not allowed,you have to start again.';
unset($_SESSION['answer_array']);
unset($_SESSION['qid_array']);
session_destroy();
header("location: nem.php?msg=$msg");
exit();
}
}
?>
<! DOCTYPE html>
<html>
<head>
<title>Quize Page</title>
<script>
function countDown(secs,elem){
var element = document.getElementById(elem);
element.innerHTML="you have "+secs+" seconds remaining.";
if(secs<1){
var xhr=new XMLHttpRequest();
var url = "userAnswers.php";
var vars= "radio=0"+"$qid="+<?php echo $question; ?>;
xhr.open("POST",url,true);
xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
xhr.onreadystatechange=function() {
if(xhr.readyState == 4 && xhr.status == 200){
alert("You didnot answer the question in alloted time.it will marked as incorrect.");
clearTimeout(timer);
}
}
xhr.send(vars);
document.getElementById('counter_status').innerHTML = "";
document.getElementById('btnSpan').innerHTML = '<h2>Time up!</h2>';
document.getElementById('btnSpan').innerHTML += '<a href="nem.php">Click here</a>';
}
secs--;
var timer=setTimeout('countDown('+secs+',"'+elem+'")',1000);
}
</script>

<script>
function getQuestion(){
 var hr = new XMLHttpRequest();
     hr.onreadystatechange = function(){
	 if(hr.readyState==4 && hr.status==200){
	 var response =hr.responseText.split("|");

	
	 if(response[0] == "finished"){
	 document.getElementById('status').innerHTML=response[1];
	 }
 var nums = hr.responseText.split(",");
     document.getElementById("question").innerHTML= nums[0];
	 document.getElementById("answers").innerHTML= nums[1];
	 document.getElementById("answers").innerHTML += nums[2];
	 
	 }
	 }
	 hr.open("GET","questions.php?question=" + <?php echo $question; ?>, true);
	 hr.send();
	 }
	 function x() {
	 var rads= document.getElementsByName("rads");
	 for(var i=0;i< rads.length; i++){
	 if (rads[i].checked){
	 var val = rads[i].value;
	 return val;
	 }
	 }
	 }
	 function post_answer(){
	 var p = new XMLHttpRequest();
	 var id = document.getElementById('qid').value;
	 var url = "userAnswers.php";
	 var vars= "qid="+id+"&radio="+x();
	 p.open("POST",url,true);
	 p.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	 p.onreadystatechange = function(){
	 if(p.readyState == 4 && p.status == 200){
	 document.getElementById("status").innerHTML = '';
	 var url = 'quiz.php?question=<?php echo $next; ?>';
	 window.location=url;
	 }
	 }
	 p.send(vars);
	 document.getElementById("status").innerHTML = "processing..";
	 }
	 </script>
	 <script>
	 window.oncontextmenu= function(){
	 return false;
	 }
	 </script>
</head>
<body onLoad="getQuestion()">
<div id="maindiv" style="height:540px;">
<br><br>
<div style="margin-left:20px;" id="status">
<br>
<div id="counter_status"></div><br><br><br>
<div style="font-size:80%;" id="question"><br><br></div>
<div id="answers"><br><br></div>
<br>
</div>
</div>
<script type="text/javascript">countDown(30,"counter_status");</script>
</body>
</html>
<?php include("footer.php"); ?>