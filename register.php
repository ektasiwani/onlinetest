<?php require_once("conect.php"); ?>
<?php include("header.php"); ?>

<?php
if(!loggedin()){
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_again'])){
 $name1= $_POST['name'];
 $name= mysql_real_escape_string(trim($name1));
 $email1= $_POST['email'];
 $email= mysql_real_escape_string(trim($email1));
 $password1= $_POST['password'];
  $password= mysql_real_escape_string(trim($password1));
 $password_again=$_POST['password_again'];
 if(!empty($name) && !empty($email) && !empty($password) && !empty($password_again)){
 if($password != $password_again){?>
  <p style="color:red; margin-left:176px; font-size:40;">Passwords doesnot match</p>
  <?php
}
 else{
 $query="SELECT * FROM users WHERE name='".$name."' AND email='".$email."'";
 $query_run= mysql_query($query) or die(mysql_error());
 if(mysql_num_rows($query_run)==1){?>
  <p style="color:red; margin-left:176px; font-size:40;">Username <?php echo $name ?> already exist..</p>
<?php
 }
else{ 
 $query="INSERT INTO users (name,email,password) VALUES ('".$name."','".$email."','".$password."')";
 $query_run=mysql_query($query);?>
<p style="color:black; margin-left:176px; font-size:40;">Registered<p>
<?php 
}}
 }else{?>
 <p style="color:red; margin-left:176px; font-size:40;">Fill all the field..</p>
<?php
}
}
}
?>
 <div id="maindiv" style="height:540px;">
 <br>
 <p style="font-size: 100%; margin-left:50px;"><u><b><i>REGISTER</i></b></u></P>
<form action="register.php" method="POST" autocomplete="off" style="font-size: 90%; margin-left:50px;"><br>
Username : <input type="text" name="name" maxlength="30" placeholder="Username"><br><br>
Email id : <input type="email" name="email" maxlength="40" placeholder="Email id"><br><br>
Password : <input type="password" maxlength="10" name="password" placeholder="Password" ><br><br>
Confirm Password : <input type="password" maxlength="10" name="password_again" placeholder="Confirm password"><br><br>
<input type="submit" name="submit" value="submit"><br><br>
</form>
</div><div class="clear">
</div>
<?php include("footer.php"); ?>