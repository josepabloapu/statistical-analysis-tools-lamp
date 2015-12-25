<?php
require_once("resources/config.php");
require_once(TEMPLATES_PATH . "/header.php");
?>

<div id="body">

<center><h1>Bienvenido(a)</h1></center>

Esta base de datos tiene como objetivo permitirle al personal autorizado obtener estadísticas inmediatas de los estudiantes. 

Es capaz de obtener la nota: promedio, la varianza, la moda, la máxima, la mínima y porcentaje de notas superiores a 7.0, donde estas mismas pueden ser filtradas por recinto, año, periodo, materia y carné.


<br>
<br>
<center>
<table border="1"> 
  <tr bgcolor= abc837>
    <td>pk</td>
    <td>id</td>
    <td>campus</td>
    <td>year</td>
    <td>period</td>
    <td>group</td>
    <td>course</td>
    <td>grade</td>
  </tr>
  <tr> 
    <td>1</td>
    <td>971135</td>
    <td>61</td>
    <td>1998</td>
    <td>2</td>
    <td>99</td>
    <td>MA1001</td>
    <td>RJ</td>
  </tr>
<tr>
    <td>2</td>
    <td>B10407</td>
    <td>11</td>
    <td>2003</td>
    <td>1</td>
    <td>1</td>
    <td>IE01117</td>
    <td>10</td>
  </tr>
</table>
	
<br>
	
	<form method="post" action="redirect.php">
    		<select name="query"> 
        		<option value="" selected="selected"></option>
        		<option VALUE="average"> Promedio</option>
        		<option VALUE="maximum"> Máximo</option>
        		<option VALUE="minimum"> Mínimo</option>   
			<option VALUE="mode"> Moda</option>
        		<option VALUE="variance"> Varianza</option>   
			<option VALUE="whopasswhofail"> Porcentaje de aprobación</option>
    		</select>
    		<INPUT TYPE="submit" VALUE="Enter" />
	</form>
</center>
<br>
</div>
<?php
require_once(TEMPLATES_PATH . "/footer.php");
?>
