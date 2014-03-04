<?php require_once("conect.php"); ?>
<?php include("header.php"); ?>


<?php

$query = "SELECT DISTINCT username,percentage FROM quiz_takers ORDER BY percentage DESC limit 3";
 
 $result= mysql_query($query) or die(mysql_error());


?>
 <div id="maindiv" style="height:900px;">
<?php
 if (mysql_num_rows($result) > 0){
define('COLS', 3); // number of columns
$col = 0; // number of the last column filled

echo '<table border="8px" style="width:500px">';
echo '<tr>'; // start first row

while ($rows = mysql_fetch_array($result))
{

 $col++;
  if ($col == COLS) // have filled the last row
  { $col = 0;
    echo '</tr><tr>'; // start a new one
  }
  echo '<tr>';
    echo '<th>', '<center>', '<br>','<br>','<br>', '<u>','Username','</u>', '<br>', '<br>','<br>', '</center>', '</th>';
  echo '<th>', '<center>', '<br>','<br>','<br>', '<u>', 'Percentage','</u>', '<br>', '<br>', '<br>', '</center>', '</th>';
 
  echo '</tr>';
  echo '<tr>';
  echo '<td>', '<center>','<br>', mysql_real_escape_string(trim($rows[0])) ,'<br>','<br>','<br>','<br>', '</center>', '</td>';
  echo '<td>', '<center>','<br>',  (int)$rows[1] ,'<br>','<br>', '</center>', '</td>';
  
  echo '</tr>';

}
echo '</tr>'; // end last row
echo "</table>";
}

// free result set memory
mysql_free_result($result);
?>
</div><div class="clear">
</div>
<?php include("footer.php"); ?>
