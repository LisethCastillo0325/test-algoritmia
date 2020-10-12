<?php
    /**
     * Se observa que la trama de datos no proporsiona información suficiente para saber 
     * si el viajero entra o sale de la estación.
     *   
     * Informacion como hora de entrada, hora de salida, estación origen y destino.
     * Tampoco  se puede obtener claramente una información de recorrido para
     * hacer el respectivo descuento en el saldo. 
     */

    

    const DIA_DOMINGO = 0;
    const DIA_SABADO  = 6;
    $trama_datos_json = getDatos();
    $trama_datos_array = json_decode($trama_datos_json, true); 

    //var_dump($trama_datos_array );
    

    $nro_tarjeta         = $trama_datos_array['nro_tarjeta'];
    $saldo               = $trama_datos_array['valor'];
    $ultimo_acceso       = $trama_datos_array['ultimo_acceso'];
    $ultimo_valor_pagado = $trama_datos_array['ultimo_valor_pagado'];
    $estacion            = $trama_datos_array['estacion'];
    $torno               = $trama_datos_array['torno'];
   
    
    $tarjeta_array = array();
    $abrir_torno_salida = true;
    $mensaje = "";
    

    /**
     * Torno entrada
     * Con base en los datos que se tienen, se podria decir que si la fecha 
     * de ultimo acceso es menor a la actual entonces se está ingresando a la estación. 
     * y si es igual entoces se está saliedo de la estación. 
     */
    if($ultimo_acceso < date('Y-m-d') ){

        $trama_datos_array['hora_entrada'] = date('h:m:i');
        $trama_datos_array['estacion_origen'] = $estacion;
        $trama_datos_array['ultimo_acceso'] = date('Y-m-d');

    }else if($ultimo_acceso == date('Y-m-d')){
        // torno destino

        $valor_recorrido_efectuado = 5500;
        if(in_array(date('w'), array(DIA_DOMINGO, DIA_SABADO))){
            // promociones y/o  descuentos
            $descuentos = 0;
        }

        $total_recorrido = $valor_recorrido_efectuado - $descuentos;
        $nuevo_saldo = $saldo - $total_recorrido;

        if(($nuevo_saldo) <= 0){
            $mensaje .= "<br>Saldo insuficiente, por favor recargue su tarjeta.";
            $abrir_torno_salida = false;
        }else{

            $trama_datos_array['valor'] = $nuevo_saldo;
            $trama_datos_array['hora_salida'] = date('h:m:i');
            $trama_datos_array['estacion_destino'] = $estacion;
            $trama_datos_array['fecha_salida'] = date('Y-m-d');

        }
    }

    echo "<br> TARJETA: " . $trama_datos_array['nro_tarjeta'];
    echo "<br> SALDO: " . $trama_datos_array['valor'];
    echo "<br> ENTRADA: " . $trama_datos_array['ultimo_acceso'] . "  ".$trama_datos_array['hora_entrada'];
    echo "<br> ESTACION ORIGEN: " . $trama_datos_array['estacion_origen'];
    echo "<br> SALIDA: " . $trama_datos_array['fecha_salida'] . "  ".$trama_datos_array['hora_salida'];
    echo "<br> ESTACION DESTINO: " . $trama_datos_array['estacion_destino'];


    function getDatos(){
        return '{
            "nro_tarjeta": "0001", 
            "valor": 150000,
            "ultimo_acceso": "2020-08-15",
            "ultimo_valor_pagado": 1500,
            "estacion": "SANTA MONICA", 
            "torno": 7
        }';
    }

?>