<?php include("header.php"); ?>
<div id="maindiv" style="height: 540px;">
<br>
<P style="color:red; font-size:100%; margin-left:100px; ">Invalid Password Or Username..</P>

<form action="logform.php" method="POST" autocomplete="off" style="font-size:100%; margin-left:100px;"><br>
Username: <input type="text" name="username"><br><br>
Password:<input type="password" name ="password"><br><br>
<input type="submit" name="submit" value="login"><br>
</form><br>
</div><div class="clear">
</div>
<?php include("footer.php"); ?>