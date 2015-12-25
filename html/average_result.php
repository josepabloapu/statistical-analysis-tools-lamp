<!--
	This is the average computing module. It displays
	the result filtered by the user parameters.
-->
<?php
require_once("resources/config.php");
require_once("resources/query.php");
require_once(TEMPLATES_PATH . "/header.php");
?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<div id="content" align="center">

<div id="leftside" align="left">


	<form>
	<INPUT Type="BUTTON" VALUE="Inicio" ONCLICK="window.location.href='/main.php'" style="height: 40px; width: 200px"> 
	<br>
	<INPUT Type="BUTTON" VALUE="Documentación" ONCLICK="window.location.href='http://pris.eie.ucr.ac.cr/eie/'" style="height: 40px; width: 200px">
	<br>
	<INPUT Type="BUTTON" VALUE="Cerrar Sesión" ONCLICK="window.location.href='/admin.php'" style="height: 40px; width: 200px">
	<br>
	<INPUT Type="BUTTON" VALUE="Inicio" ONCLICK="window.location.href='/main.php'" style="height: 40px; width: 200px"> 
	<br>
	<INPUT Type="BUTTON" VALUE="Documentación" ONCLICK="window.location.href='http://pris.eie.ucr.ac.cr/eie/'" style="height: 40px; width: 200px">
	<br>
	<INPUT Type="BUTTON" VALUE="Cerrar Sesión" ONCLICK="window.location.href='/admin.php'" style="height: 40px; width: 200px">
	<br>
	</form>

</div>

<div id="rightside">

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

<br>
<hr>
<br>

<?php
/*
	This will iterates row by row. But in this case is only one row. The importan part here
	is the mysql_fetch_assoc, that will transform to an array that php can display.
*/
while($row = mysql_fetch_assoc($result_average)){
  $string = "The average of grades is $row[average]";
  $new_string = substr($string, 0, 29); // it removes, the lots of decimals
  echo "$new_string";
}
echo "<br>In $entries entries<br>"; //displays the number of rows (entries).



?>

</div>

<div id="graph">
hello
</div>






<br>
</div>

<?php
require_once(TEMPLATES_PATH . "/footer.php");
?>
