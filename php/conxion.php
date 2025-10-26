<?php
$server = "localhost" ;
$user = "root" ;
$clave = "" ;
$database = "banorte_smart_city" ;

//conecar con la abse de datos 

$conn = mysqli_connect($server,$user,$clave,$database);

if(!$conn){
    die("error al intentar la conexion". mysqli_connect_error() );
}
else
{
 //   echo "conexion exitosa a base de datos".$database ;
}

?>