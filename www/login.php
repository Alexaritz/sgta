<?php
/* Define los valores que seran evaluados, en este ejemplo son valores estaticos,
en una verdadera aplicacion generalmente son dinamicos a partir de una base de datos */


$usuarioValido = "revolucion";
$passwordValido = "movil";
/* Extrae los valores enviados desde la aplicacion movil */
$usuarioEnviado = $_GET['usuario'];
$passwordEnviado = $_GET['password'];


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
$erantzuna["hora"] = date("F j, Y, g:i a"); 
$erantzuna["generador"] = "Enviado desde revolucion.mobi" ;

		$erab = $mysqli->query( "SELECT * FROM erabiltzailea WHERE username=('$usuarioEnviado') and password=('$passwordEnviado')" );
		$num_rows=mysqli_num_rows($erab);
		if ($num_rows> 0){
			$erantzuna["mensaje"] = "Datu zuzenak.";
			$erantzuna["validacion"] = "ok";
			/*echo "<p>Datuak zuzenak dira.</p>";
			$_SESSION['username'] = $Username;
			mysqli_close($mysqli);
			header('Location: bezero.html');
			//erabiltzailea existtizen ez bada errore mezua*/
		}else{
			$erantzuna["mensaje"] = "Erabiltzaile eta pasahitz okerrak.";
			$erantzuna["validacion"] = "error";
			/*echo '<div align="center">';
			echo '<p align="center">Kontu hori ez dago datu basean.</p>';
			echo'<p align="center"><a href="login.html" title="Atzera">Atzera</a></p>';
			echo'<img  id="imagen_centrada" src="images/sad.gif" alt="Sad"/>';*/
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