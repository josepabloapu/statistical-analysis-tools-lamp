#!/usr/bin/perl

#**************************************************************************************
#Instrucciones:
#**************************************************************************************

#	1- Copiar este archivo en el mismo directorio donde se encuentran original.csv, student.csv y subject.csv. 

#	2- Abrir la terminal de comandos en es este directorio y escribir: perl fixTable.pl

#	3- Una vez que se ejecuta el programa produce una tabla llamada tabmodf.csv que tiene corregidos los posibles errores de original.csv, y dos tablas nuevaStudent y nuevaSubject con los carnes y siglas que faltaban

#**************************************************************************************

open (FILA,"original.csv");
chop(@tabla=<FILA>);
close (FILA);

$indiceCarne=1,$indiceSigla=1;

open (CARNE,"student.csv");
chop(@idCarne=<CARNE>);

open (SIGLA,"subject.csv");
chop(@idSigla=<SIGLA>);
open (TABMOD,">tablamodf.csv");

#************************************************

for $fila (@tabla)
{
	@vDatos=split(/;/,$fila);
	
	while ($vDatos[1] =~ /\D/)
	{
		splice(@vDatos,1,1);
	}

	if($vDatos[6]>10)
	{
		$vDatos[5]=$vDatos[5].$vDatos[6];	
		splice(@vDatos,6,1);
	}	

#************************************************

	for $fila (@idSigla){
		@vSigla=split(/,/,$fila); 
		if ($vSigla[1] eq $vDatos[5]){
			$vDatos[5]=$vSigla[0];	
		}
	}	#fin for
	if($vDatos[5]=~ /\D/){
	$id=$#idSigla+2;
		push(@idSigla,"$id,$vDatos[5]");
	$vDatos[5]=$#idSigla+1;
	}
	
#************************************************

	if($carneAnterior!=$vDatos[0]){
		for $fila (@idCarne){
			@vCarne=split(/,/,$fila); 
			if ($vCarne[1] == $vDatos[0]){
				$vDatos[0]=$vCarne[0];	
			}
			$carneAnterior=$vDatos[0];
			$idCarneAnterior=$vCarne[0];
		}	
	}
	
	else{
		$vDatos[0]=$idCarneAnterior;
	}
	if($vDatos[0]>1000){
	$id=$#idCarne+2;
		push(@idCarne,"$id,$vDatos[0]");
	$vDatos[0]=$#idCarne+1;
	}
	
#************************************************

	$nuevaTabla=join(";",@vDatos);
	print TABMOD $nuevaTabla."\n";
	
}

#************************************************

open (CARNE,">nuevaStudent.csv");
open (SIGLA,">nuevaSubject.csv");

for $fila (@idSigla){
	$nuevaSubject=join(",",$fila); 
	print SIGLA $nuevaSubject."\n";
}

for $fila (@idCarne){
	$nuevaStudent=join(",",$fila); 
	print CARNE $nuevaStudent."\n";
}

close (TABMOD);
close (SIGLA);
close (CARNE);

