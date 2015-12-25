<?php

/*
The important thing to realize is that the config file should be included in every
page of your project, or at least any page you want access to these settings.
This allows you to confidently use these settings throughout a project because
if something changes such as your database credentials, or a path to a specific resource,
you’ll only need to update it here.
*/
$config = array(
	"db" => array(
		"dbname" => "eie",
		"username" => "root",
		"password" => "rovNSZY0y5wHI7N2nMepVY",
		"host" => "localhost"
		),
	"urls" => array(
		"baseUrl" => "http://localhost/main.php"
		),
	"paths" => array(
		"resources" => "/var/www/resources",
		"images" => "/var/www/img"
		),
	"tables" => array(
		"table0" => "main",
		"table1" => "general",
		"table2" => "carnet",
		"table3" => "courseCode"
		),
	"filter" => array(	//This array catches al the filter variables from average.php.
		"id" => $_POST["id"],
		"campus" => $_POST["campus"],
		"from_year" => $_POST ["from_year"],
		"to_year" => $_POST ["to_year"],
		"period" => $_POST ["period"],
		"course" => $_POST ["course"],
		),
	);

$connection = mysql_connect($config[db][host], $config[db][username], $config[db][password]);
mysql_select_db($config[db][dbname], $connection); 

/*
	These joins are the ones that links the 3 tables. 
*/
$join1 = $config[tables][table0]." JOIN ".$config[tables][table2]." ON ".$config[tables][table2].".id=".$config[tables][table0].".carnet";
$join2 = $config[tables][table0]." JOIN ".$config[tables][table3]." ON ".$config[tables][table3].".id=".$config[tables][table0].".course";
$join = "JOIN $join1 JOIN $join2";

/*
	These arrays help to manage the iterations easier. 
*/
$wfields = array("id","campus","from year","to year","period","course");
$sfields = array("id","campus","from_year","to_year","period","course");
//$rfields = array("carne_id","recinto","anio>","anio<","ciclo","sigla_id");
$rfields = array("id","campus","year>","year<","period","course");

/*
	Counter, It check if the filter atributes are null, If $filter = 6, filter atributes are null
*/
for ($y=0;$y<6;$y++){
  if ($config["filter"][$sfields[$y]] == ""){
    $filter = $filter + 1;
  }
}
/*
	Creates a new array similar to $filter_atribute, but is this case each vector
	has the parameter that mysql understands to filter the query.
*/
for ($x=0;$x<6;$x++){
  if ($config["filter"][$sfields[$x]] != ""){
    $new_filter_atribute[$sfields[$x]] = "AND ".$rfields[$x]."='".$config["filter"][$sfields[$x]]."'";
  }
}
/*
	Concatenate the $filter_string with the $new_filter_atribute vectors.
*/
foreach ($new_filter_atribute as $value) {
	$filter_string .= "$value ";
}
/*
Creating constants for heavily used paths makes things a lot easier.
ex. require_once(LIBRARY_PATH . "Paginator.php")
*/
defined("LIBRARY_PATH")
or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));

defined("TEMPLATES_PATH")
or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

/*
Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
?>
