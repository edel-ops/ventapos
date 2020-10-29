<?php

$numero = 0;
if (isset($_POST["numero"])) {
   
    $numero = $_POST["numero"];

}

 

if (isset($_POST["monto_tarjeta"]))

{

	$monto = $_POST["monto_tarjeta"] + $numero;

}

include "vender.php";
//si permitimos este header la pagina se reinicia y borra la variable monto
//header("Location: ./vender.php");
?>