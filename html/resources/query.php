<?php
/*
	Here is the list of all queries, it must run with config.php
	to connect with mysql server
*/
$query_count = sprintf("
	SELECT grade 
	FROM ".$config[tables][table1]." 
	WHERE grade!=0 $filter_string;");
$result_count = mysql_query($query_count) or die(mysql_error());
$entries = mysql_num_rows($result_count);

$query_average = sprintf("
	SELECT AVG(grade) AS average 
	FROM ".$config[tables][table1]." 
	WHERE grade!=0 $filter_string;");
$result_average = mysql_query($query_average) or die(mysql_error());

$query_max = sprintf("
	SELECT MAX(grade) AS maximum 
	FROM ".$config[tables][table1]." 
	WHERE grade!=0 $filter_string;");
$result_max = mysql_query($query_max) or die(mysql_error());

$query_min = sprintf("
	SELECT MIN(grade) AS minimum 
	FROM ".$config[tables][table1]."
	WHERE grade!=0 $filter_string;");
$result_min = mysql_query($query_min) or die(mysql_error());

$query_mode = sprintf("
	SELECT grade, COUNT(*) AS repetitions 
	FROM ".$config[tables][table1]." 
	WHERE grade>=0 $filter_string 
	GROUP BY grade 
	ORDER BY repetitions DESC;");
$result_mode = mysql_query($query_mode) or die(mysql_error());

$query_variance = sprintf("
	SELECT VARIANCE(grade) AS variance 
	FROM ".$config[tables][table1]."
	WHERE grade!=0 $filter_string;");
$result_variance = mysql_query($query_variance) or die(mysql_error());

$query_pass = sprintf("
	SELECT grade
	FROM ".$config[tables][table1]." 
	WHERE grade>=7 $filter_string;");
$result_pass = mysql_query($query_pass) or die(mysql_error());
$entries_pass = mysql_num_rows($result_pass);
?>
