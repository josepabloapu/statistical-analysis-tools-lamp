<!--	
	This file manage the user's selection from main
	to access the queries page.
	As you can see, the only valid choices are
	average, maximum, minimum, mode and variance.
	Since program will be upgrading, these choices may increse.
--> 
<?php
$valid_choices = array('average','maximum','minimum','mode','variance','whopasswhofail');
$queries = (isset($_POST['query'])) ? $_POST['query'] : ''; //determines if the variable is difined and is no null.
if ( $queries && in_array($queries, $valid_choices) ) { //checks if the variable $queries is included in valid choices.
  switch ($queries) {
    case 'average':
      $url = "average.php"; //sets $url to average.php
      break;
    case 'maximum':
      $url = "maximum.php"; //sets $url to maximum.php
      break;
    case 'minimum':
      $url = "minimum.php"; //sets $url to minimum.php
      break;
    case 'mode': 
      $url = "mode.php"; //sets $url to mode.php
      break;
    case 'variance':
      $url = "variance.php"; //sets $url to mode.php.
      break;
    case 'whopasswhofail':
      $url = "whopasswhofail.php"; //sets $url to whopasswhofail.php.
      break;
  }
  header('Location: ' . $url); //redirects to the variable $url.
} 
else {
  header('Location: main.php'); //redirects to the main page, because it was selected a invalid choice.
}
?>

