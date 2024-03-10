<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $opcionSeleccionada=$_POST["opcion"];

    if($opcionSeleccionada=="opcionSi"){

        echo "eligio si";
    }

    else{

        echo "eligio no";

    }
}

?>