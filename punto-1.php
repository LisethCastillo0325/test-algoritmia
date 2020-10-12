<?php

    /**
     * crear un vector de 100 posiciones y cargarlo dinámicamente
     * con valores entre 1 y 100000.
     */
    $size = 100;
    $array = array();
    //$array = new SplFixedArray($size);

    for ($i=0; $i < $size ; $i++) { 
        $array[$i] = random_int(1, 100000);
        //echo "\n".$array[$i];
    }
   
    rsort($array);
    echo "<br> ORDEN DE MAYOR A MENOR <br>";

    for ($i=0; $i < sizeof($array) ; $i++) { 
        echo "<br> ".$array[$i];
    }


?>