<!--
	This is the main page of variance module. It displays
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
	<h1>Obtener la Varianza</h1>
	
    <p>Seleccione los parámetros que quiere filtra</p>
    <p>Deje vacío si no quiere filtrar la operación</p>

	<form action="variance_result.php" method="POST"> 	
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
