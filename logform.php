<?php require_once("conect.php"); ?>
<?php include("header.php"); ?>
<?php
if(isset($_POST['username']) && isset($_POST['password'])){
$username1= $_POST['username'];
$username= mysql_real_escape_string(trim($username1));
$password1= $_POST['password'];
$password= mysql_real_escape_string(trim($password1));
$password_hash= md5($password);

//check if empty

if(!empty($username) && !empty($password))

{ global $con;
$sql= (" SELECT id FROM users WHERE name='$username'  AND password='$password'") or die(mysql_error());

$run= mysql_query($sql);
$num=mysql_num_rows($run);
//check if user exist
if($num==0){
header('Location: invalide.php ') ;
}elseif($num==1)
{
$user_id= mysql_result($run,0,'id');
$_SESSION['user_id']=$user_id;
echo 'done';
header('Location: index.php ') ;}
}else{
header('Location: empty.php ') ;
}
}
?>
<div id="maindiv" style="height:540px;">
<br><p style="font-size:100%; margin-left:100px;"><u><b><i>Login</i></b></u></p>
<form action="logform.php" method="POST" autocomplete="off" style="font-size:100%; margin-left:100px;"><br>
Username : <input type="text" name="username" placeholder="Username" ><br><br>
Password :<input type="password" name ="password" placeholder="Password"><br><br>
<input type="submit" name="submit" value="login">
</form><br>
<p style="font-size:100%; margin-left:100px;">If you are new user register here..</p>
<a  style="font-size:100%; margin-left:100px;" href="register.php">REGISTER</a>
</div><div class="clear">
</div>
<?php include("footer.php"); ?>