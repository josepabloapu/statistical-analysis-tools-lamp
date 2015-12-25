#!/usr/bin/perl
open (REPORT,">/var/www/resources/report/report.tex");
open(ORIGINAL, "/var/www/resources/report/template.tex");
$id = $ARGV[0];
$campus = $ARGV[1];
$from_year = $ARGV[2];
$to_year = $ARGV[3];
$period = $ARGV[4];
$course = $ARGV[5];
$result = $ARGV[6];
$entries = $ARGV[7];
$operation = $ARGV[8];
chop(@reportOriginal=<ORIGINAL>);
for $_ (@reportOriginal){
	s/subcarne/$id/;
	s/subcampus/$campus/; 
	s/subinicio/$from_year/; 
	s/subfin/$to_year/;
	s/subperiodo/$period/;
 	s/subcurso/$course/;
 	s/suboperacion/$operation/;
 	s/subresultado/$result/;
 	s/subentradas/$entries/;
	print REPORT $_."\n";
}
system('make');
close (ORIGINAL);
close (REPORT);
