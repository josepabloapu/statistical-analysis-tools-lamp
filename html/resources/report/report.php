<?php
require_once("resources/config.php");
$id = $config[filter][id];
$campus = $config[filter][campus];
$from_year = $config[filter][from_year];
$to_year = $config[filter][to_year];
$period = $config[filter][period];
$course = $config[filter][course];
$result = "7.0";
$entries = "50";
$operation="average";
exec("perl Gen_Report.pl $id $campus $from_year $to_year $period $course $result $entries $operation");
#exec("perl /home/diego/git/cerberus/programa/reporte/Gen_Report.pl $id $campus $from_year $to_year $period $course $result $entries $operation");
?>
