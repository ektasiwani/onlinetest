<?php include("header.php"); ?>
 <div id="maindiv" style="height:540px;">
 <br>
 <?php 
 echo '<center>','<br>','<br>','To know your last 10 attempt history fill the form given below','<br>','<br>','</center>';
 ?>
 <p style="font-size: 100%; margin-left:50px;"><u><b><i>Fill all the field</i></b></u></P>
<form action="score.php" method="POST" autocomplete="off" style="font-size: 90%; margin-left:50px;"><br>
Full name : <input type="text" name="name" maxlength="30" placeholder="Full name"><br><br>



<input type="submit" name="submit" value="submit"><br><br>
</form>
</div><div class="clear">
</div>
<?php include("footer.php"); ?>