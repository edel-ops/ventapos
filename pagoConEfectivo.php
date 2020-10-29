<?php

$numero = 0;
if (isset($_POST["numero"])) {
   
    $numero = $_POST["numero"];

}

 

if (isset($_POST["monto_efectivo"]))

{

	$monto = $_POST["monto_efectivo"] + $numero;

}

include "vender.php";
//si permitimos este header la pagina se reinicia y borra la variable monto
//header("Location: ./vender.php");
?>