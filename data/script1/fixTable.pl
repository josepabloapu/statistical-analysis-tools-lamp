#!/usr/bin/perl

#**************************************************************************************
#Instrucciones:
#**************************************************************************************
#	1- Copiar este archivo en el mismo directorio donde se encuentran original.csv, student.csv y subject.csv. 

#	2- Abrir la terminal de comandos en es este directorio y escribir: perl fixTable.pl

#	3- Una vez que se ejecuta el programa produce una tabla llamada tabmodf.csv que tiene corregidos los posibles errores de original.csv

#**************************************************************************************
# Comentarios generales:
#**************************************************************************************
#	El programa se divide en partes: 

# 1- La primera parte convierte todo el archivo en un array @tabla, donde cada elemento es una linea del archivo, además en ese array gigante que se va a crear, se sustituyen de una vez carnés y siglas por IDs de las tablas subject y student.csv

# 2- La segunda parte se encarga de tomar ese array y corregir los errores, eliminando nombres y uniendo siglas divididas, también hay algunos carnes y siglas que no se pudieron sustituir en la primera parte porque no estaban en las tablas subject y student.csv

#**************************************************************************************
#Comentarios del código
#**************************************************************************************
#--------------------------------------------------------------------------------------
#Primera Parte
#--------------------------------------------------------------------------------------

#	Abrimos con open() en modo lectura el archivo original.csv, que contiene la tabla con errores, pasamos cada linea de este a un array llamado @tabla, y lo cerramos

# @tabla=("731638;EDWIN;11;1993;1;1;IE0513;PE;","731638;EDWIN;11;1994;2;1;IE0503;RJ;", "731638;EDWIN;11;1994;1;1;IE0513;PE;", ........)

open (FILA,"original.csv");
chop(@tabla=<FILA>);
close (FILA);

#	Inicializacion de las variables que mostraran ek numero de la ultima linea de los archivos student.csv y subjects.csv

$indiceCarne=1,$indiceSigla=1;

#	Abrimos la lista con carnes y pasamos cada linea a un array
open (CARNE,"student.csv");
chop(@idCarne=<CARNE>);

#	Este for se encargará de sustituir en @tabla, los carnes por su id correspondiente. 

for $fila (@idCarne){

#	Utilizamos split para la división de una cadena (cada linea del archivo) en distintos campos, usando como delimitador la ",". Por lo que obtenemos un array con el indice y el carne correspondiente.

#	ejemplo: @vCarne=(258,950333)

	@vCarne=split(/,/,$fila); 
# Sustituimos en @tabla los carne por los id con el siguiente for:
	for (@tabla){
		$id=$vCarne[0];
		$carne=$vCarne[1];
		s/$carne/$id/; #sustitucion
	}
	$indiceCarne++;
}

#tabla quedaría así: 
# @tabla=("#iddecarne;EDWIN;11;1993;1;1;IE0513;PE;","#iddecarne;EDWIN;11;1994;2;1;IE0503;RJ;", "#iddecarne;EDWIN;11;1994;1;1;IE0513;PE;", ........)

open (SIGLA,"subject.csv");
chop(@idSigla=<SIGLA>);

#	Este for se encargará de sustituir en @tabla, las siglas por su id correspondiente. 

for $fila (@idSigla){
	@vSigla=split(/,/,$fila);
	for (@tabla){
		$id=$vSigla[0];
		$sigla=$vSigla[1];
		s/$sigla/$id/;
	}
	$indiceSigla++;
}

#tabla quedaría así: 
#@tabla="#iddecarne;EDWIN;11;1993;1;1;#iddesigla;PE;","#iddecarne;EDWIN;11;1994;2;1;#iddesigla;RJ;", "#iddecarne;EDWIN;11;1994;1;1;#iddesigla;PE;", ........)

close (SIGLA);
close (CARNE);

#--------------------------------------------------------------------------------------
#Segunda Parte
#--------------------------------------------------------------------------------------


#	Se abre el archivo tablamodf.cvs el cual contendrá la tabla original.csv corregida, como se puede observar se utiliza el símbolo ">", que significa escritura.

open (TABMOD,">tablamodf.csv");


# Se abren los archivos student.csv y subject.csv los cuales contienen las tablas de carne y siglas con sus id, se abren con >> ya que se le agregaran al final del archivo los valores de carne y siglas que no estaban originalmente en estos, con sus respectivos ids.
open (CARNE,">>student.csv");
open (SIGLA,">>subject.csv");


#	Una vez ya sustituidos los carnes y siglas por sus ids, el siguiente for recorrerá fila por fila de el array tabla, y utilizará split para dividir cada una en arrays de elementos delimitados por ";".
for $fila (@tabla)
{
	@vDatos=split(/;/,$fila);
	
# por ejemplo: "@vDatos:(#iddecarne,EDWIN,11,1993,1,1,#iddesigla,PE)
	
#	Una vez obtenidos los array, se verifican si contienen los errores:

#	ERROR 1: Si en la casilla del recinto o año hay un nombre:

#	Este while se encarga de detectar si la casilla 1, recinto, tiene elementos que no sean numeros, en caso de que tenga letras, elimina la casilla con la funcion splice.
	while ($vDatos[1] =~ /\D/)
	{
		splice(@vDatos,1,1);
	}

#	ERROR 2: Si la sigla está divida en dos partes (dos casillas)

# Un if detecta si la casilla correspondiente a la nota tiene un valor mayor a 10, es decir que tenga la segunda parte de la sigla en lugar de la nota, en caso de que el error esté presente, se concatena con la casilla anterior, la de la sigla, y se elimina con splice.	
	if($vDatos[6]>10)
	{
		$vDatos[5]=$vDatos[5].$vDatos[6];	
		splice(@vDatos,6,1);
	}	

#	ERROR 3: Carne no encontrado en students.csv

# el if verifica si el campo de id carné aún contiene un carné (número muy grande), en lugar de un ID. En caso de encontrarlo, lo agrega a students.csv con su id correspondiente ($indiceCarne) y le asigna el este mismo valor a la casilla correpondiente al idcarné.


	if($vDatos[0]>1000){
		print CARNE "$indiceCarne,$vDatos[0]\n";
		$vDatos[0]=$indiceCarne;
		$indiceCarne++;
	}
	
#	ERROR 4: Sigla no encontrada en subjects.csv

# el if verifica si el campo de carné aún contiene una sigla (letras), en lugar de un ID. En caso de encontrarlas, la agrega a subjects.csv con su id correspondiente ($indiceSigla) y le asigna el este mismo valor a la casilla 5.

	if($vDatos[5] =~ /\D/){
		print SIGLA "$indiceSigla,$vDatos[5]\n";
		$vDatos[5]=$indiceSigla;
		$indiceSigla++;
	}

#	Por último el array se junta con la función join en una sola cadena de caracteres, en la cual cada elemento está delimitado por un ";", y se imprime sobre el nuevo archivo tablamodf.csv

	$nuevaTabla=join(";",@vDatos);
	print TABMOD $nuevaTabla."\n";
	
}
close (TABMOD);
close (SIGLA);
close (CARNE);

