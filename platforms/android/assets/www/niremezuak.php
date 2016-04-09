<?php
/* Define los valores que seran evaluados, en este ejemplo son valores estaticos,
en una verdadera aplicacion generalmente son dinamicos a partir de una base de datos */

$user = $_GET['usuario'];
/* Extrae los valores enviados desde la aplicacion movil */
/*$usuarioEnviado = $_GET['usuario'];
$passwordEnviado = $_GET['password'];*/


session_start();
$servidor = "mysql.hostinger.es";//localhost mysql.hostinger.es
$usuario = "u199017461_sgta";//root u199017461_sgta
$password = "n1fXhn9qyo";//n1fXhn9qyo
$sdb = "u199017461_sgta";//sgta

$mysqli =new mysqli ($servidor,$usuario,$password, $sdb);
//$mysqli =new mysqli ("localhost","root","", $sdb);
if ($mysqli->connect_error) {
    printf("Connection failed: " . $mysqli->connect_error);
} 



/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$erantzuna = array();
/*$erantzuna["hora"] = date("F j, Y, g:i a"); 
$erantzuna["generador"] = "Enviado desde revolucion.mobi" ;*/

		$erab = $mysqli->query( "SELECT * FROM mezua where username=('$user')" );
		$num_rows=mysqli_num_rows($erab);
		while($datos=mysqli_fetch_array($erab,MYSQLI_ASSOC)){
			$erantzuna[]=array_map('utf8_encode', $datos);
		}
		
	





/*
if(  $usuarioEnviado == $usuarioValido  && $passwordEnviado == $passwordValido ){
	$resultados["mensaje"] = "Validacion Correcta";
	$resultados["validacion"] = "ok";
}else{
	$resultados["mensaje"] = "Usuario y password incorrectos";
	$resultados["validacion"] = "error";
}*/
/*convierte los resultados a formato json*/
//echo json_encode($erantzuna);
$resultadosJson = json_encode($erantzuna);
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
?>