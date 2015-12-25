<!--
	This is the variance computing module. It displays
	the result filtered by the user parameters.
-->
<?php
require_once("resources/config.php");
require_once(TEMPLATES_PATH . "/header.php");
?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<div id="content">
<br>
<?php

$dbtable = $config[tables][table1];
$dbtablefield = grade;
$counter_entries = 0;
$counter_entries2 = 0;

/*
	This array catches al the filter variables from variance.php.
*/
$filter_atribute = [
	"id" => $_POST["id"],
	"campus" => $_POST["campus"],
	"from_year" => $_POST ["from_year"],
	"to_year" => $_POST ["to_year"],
	"period" => $_POST ["period"],
	"subject" => $_POST ["subject"],
];

/*
	Creates a new array similar to $filter_atribute, but is this case each vector
	has the parameter that mysql understand to filter the query.
*/
for ($x=0;$x<6;$x++){
  if ($filter_atribute[$sfields[$x]] != ""){
    $new_filter_atribute[$sfields[$x]] = "AND ".$rfields[$x]."='".$filter_atribute[$sfields[$x]]."'";
  }
}
/*
	Concatenate the $filter_string with the $new_filter_atribute vectors.
*/
foreach ($new_filter_atribute as $value) {
	$filter_string .= "$value ";
}
?>
<p>The filter you've done is</p>
<?php
/*
	Displays to the user what parameters he/she filtered.
*/
for ($y=0;$y<6;$y++){
  if ($filter_atribute[$sfields[$y]] != ""){
    echo $wfields[$y].": ".$filter_atribute[$sfields[$y]]."<br>";
  }
}
?>
<hr> 

<?php
/*
	Here comes the query. It selectes all the fields with the filter applied to the last query.
*/
$query = sprintf("SELECT * FROM $dbtable WHERE $dbtablefield!=0 AND grade>=7 $filter_string;");
$result = mysql_query($query) or die(mysql_error());
/*
	This will iterates row by row. So will count the number of rows it is computing.
*/
while($row = mysql_fetch_assoc($result)){
  $counter_entries = $counter_entries + 1;
}
/*
	Here comes the query. It selectes all the fields with the filter applied to the last query.
*/
$query = sprintf("SELECT * FROM $dbtable WHERE $dbtablefield!=0 $filter_string;");
$result = mysql_query($query) or die(mysql_error());
/*
	This will iterates row by row. So will count the number of rows it is computing.
*/
while($row = mysql_fetch_assoc($result)){
  $counter_entries2 = $counter_entries2 + 1;
}

$percentage = ( $counter_entries * 100 ) / $counter_entries2;
$new_percentage = number_format($percentage, 2);

echo "<br>$counter_entries students passed the course(s). Which is the $new_percentage percent of all entries<br>"; //displays the number of rows (entries).
echo "<br>In $counter_entries2 entries<br>"; //displays the number of rows (entries).
?>
<html>
<body>
  <br>
  <form method="post" action="generate_report.php">
    <INPUT TYPE="submit" VALUE="Generate Report"/>
  </form>
  <form method="post" action="whopasswhofail.php">
    <INPUT TYPE="submit" VALUE="Make another query"/>
  </form>
  <form method="post" action="main.php">
    <INPUT TYPE="submit" VALUE="Return"/>
  </form>
</body>
</html>

<?php
require_once(TEMPLATES_PATH . "/footer.php");
?>
