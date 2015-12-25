<!--
	This is the main page of who passes and who failed module. It displays
	what kind of filters are available to set on the mysql query.
-->
<?php
require_once("resources/config.php");
require_once(TEMPLATES_PATH . "/header.php");
?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<div id="content" align="center">

<html>
<body>
	<br>
	<h1>Obtener porcetaje de notas superiores a 7.0</h1>
	
	
    <p>Seleccione los parámetros que quiere filtra</p>
    <p>Deje vacío si no quiere filtrar la operación</p>

	<form action="whopasswhofail_result.php" method="POST"> 	
		<?php
		require_once(TEMPLATES_PATH . "/filterForm.php");
		?>
  	</form>
	<br>
</body>
</html>

</div>
<?php
require_once(TEMPLATES_PATH . "/footer.php");
?>
