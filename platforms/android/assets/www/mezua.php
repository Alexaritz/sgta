<?php
/* Define los valores que seran evaluados, en este ejemplo son valores estaticos,
en una verdadera aplicacion generalmente son dinamicos a partir de una base de datos */



/* Extrae los valores enviados desde la aplicacion movil */
$user = $_GET['usuario'];
$message = $_GET['message'];
$partner = $_GET['partner'];


session_start();
$servidor = "mysql.hostinger.es";//localhost mysql.hostinger.es
$usuario = "u199017461_sgta";//root u199017461_sgta
$password = "n1fXhn9qyo";//n1fXhn9qyo
$sdb = "u199017461_sgta";//u199017461_sgta

$mysqli =new mysqli ($servidor,$usuario,$password, $sdb);
//$mysqli =new mysqli ("localhost","root","", $sdb);
if ($mysqli->connect_error) {
    printf("Connection failed: " . $mysqli->connect_error);
} 



/* crea un array con datos arbitrarios que seran enviados de vuelta a la aplicacion */
$erantzuna = array();
/*$erantzuna["hora"] = date("F j, Y, g:i a"); 
$erantzuna["generador"] = "Enviado desde revolucion.mobi" ;*/

		$txertatu=("Insert into mezua(username, partner, message) values ('$user','$partner','$message')" );
		if (!$mysqli -> query($txertatu)){
			$erantzuna=die("<p>Errorea gertatu da: ".$mysqli -> error ."</p>");	
		}else{	
			$erantzuna='Erabiltzailea zuzen sartu da';
			die();
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
$resultadosJson = json_encode($erantzuna);
/*muestra el resultado en un formato que no da problemas de seguridad en browsers */
echo $_GET['jsoncallback'] . '(' . $resultadosJson . ');';
?>