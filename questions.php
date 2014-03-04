<?php
session_start();
require_once("conect.php");
$arrCount= "";
if(isset($_GET['question'])){
$question1= preg_replace('/[^0-9]/',"", $_GET['question']);
$question= mysql_real_escape_string(trim($question1));
$output = "";
$output= mysql_real_escape_string(trim($output));
$answers= "";
$q="";
$sql=mysql_query("SELECT id FROM questions");
$numQuestions = mysql_num_rows($sql);
if(!isset($_SESSION['answer_array']) || $_SESSION['answer_array']< 1){
 $currQuestion =  "1";
 }else {
 $arrCount = count($_SESSION['answer_array']);
 }
 
  if($arrCount>=$numQuestions){
  echo 'finished|<p>There is no more questions. Please enter your first and last name</p>
  <form action="userAnswers.php" method="post">
  <input type="hidden" name="complete" value="true">
  <input type="text" name="username">
  <input type="submit" value="Finish">
  </form>';
  exit();
  }
  $singleSQL= mysql_query("SELECT * FROM questions WHERE id='".$question."' LIMIT 1");
  while($row= mysql_fetch_array($singleSQL)){
  $id= (int)$row['id'];
  $thisQuestion = $row['question'];
  $thisQuestion= mysql_real_escape_string(trim($thisQuestion));
  $type = $row['type'];
  $type= mysql_real_escape_string(trim($type));
  $question_id=(int)$row['question_id'];
  $q= '<h2>'.$thisQuestion.'</h2>';
  $sql2 = mysql_query("SELECT * FROM answers WHERE question_id='".$question."' ORDER BY rand()");
  while($row2= mysql_fetch_array($sql2)){
  $answer= $row2['answer'];
  $answer= mysql_real_escape_string(trim($answer));
  $correct= $row2['correct'];
  $correct= mysql_real_escape_string(trim($correct));
  $answers .= '<label style="cursor:pointer;"><input type="radio" name="rads" value="'.$correct.'">'.$answer.'</label>
  <input type="hidden" id="qid" value="'.$id.'" name="qid"></br>';
  }
  $output = ' '.$q.','.$answers.',<span id="btnSpan"><button onclick="post_answer()">Submit</button></span>';
  
  echo $output;
  
  }
  }
  ?>