<!--
	This is the minimum computing module. It displays
	the result filtered by the user parameters.
-->
<?php
require_once("resources/config.php");
require_once("resources/query.php");
require_once(TEMPLATES_PATH . "/header.php");
?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<br>
<?php
/*
	Displays to the user what parameters he/she filtered.
*/
if ($filter != 6){
	echo "<p>The filter you've done is</p>";
	for ($y=0;$y<6;$y++){
  		if ($config["filter"][$sfields[$y]] != ""){
   			 echo $wfields[$y].": ".$config["filter"][$sfields[$y]]."<br>";
  		}
	}
}
?>
<hr> 
<?php

/*
	This will iterates row by row. But in this case is only one row. The importan part here
	is the mysql_fetch_assoc, that will transform to an array that php can display.
*/
while($row = mysql_fetch_assoc($result_min)){
  $string = "The minimum grade is $row[minimum]";
  $new_string = substr($string, 0, 29); // it removes, the lots of decimals
  echo "$new_string";
}

echo "<br>In $entries entries<br>"; //displays the number of rows (entries).
?>
<html>
<body>
  <br>
  <form method="post" action="generate_report.php">
    <INPUT TYPE="submit" VALUE="Generate Report"/>
  </form>
  <form method="post" action="minimum.php">
    <INPUT TYPE="submit" VALUE="Make another query"/>
  </form>
  <form method="post" action="main.php">
    <INPUT TYPE="submit" VALUE="Return"/>
  </form>
</body>
</html>

<br>
</div>
<?php
require_once(TEMPLATES_PATH . "/footer.php");
?>

