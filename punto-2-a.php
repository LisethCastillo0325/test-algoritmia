<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div align="center">
    <h1>Calcular Potencia</h1>
    <form action="/test-desarrollador/punto-2-a.php" method="POST">
        <table>
            <tr>
                <td>
                    <label>Ingrese el valor de la base:</label>
                </td>
                <td>
                    <input type="number" name="base" required >
                </td>
            </tr>
            <tr>
                <td>
                    <label>Ingrese el valor de la potencia:</label>
                </td>
                <td>
                    <input type="number" name="potencia" required >
                </td>
            </tr>
        </table>
        <br>
        <input type="submit" value="Calcular">
    </form>

    <?php
        if($_POST){
            $base = $_POST['base'];
            $potencia = $_POST['potencia'];
            $resultado = potencia($base, $potencia);
            
            echo "<br> <label><b>Base:</b> $base </label>".
                 "<br> <label><b>Potencia:</b> $potencia </label>";
            if($referencia === INF){
                echo "<br>Error: valores no aceptados.";
            }else{
                echo "<br> <label><b>Resultado:</b> $resultado </label>";
            }
        }

        /**
         * Esta función permite elevar un numero a otro solo usando sumas.
         * Para una potencia impar se hace el mismo procedimeinto, salvo que se resta un factor a la potencia 
         * y se multiplica dicho factor al resultado final final  
         * 
         * @param int $base
         * @param int $potencia
         * @return int $resultado
         */
        function potencia($base, $potencia){
            if($potencia%2 != 0){
                $potencia--;
                $ultimo_factor = $base;
            }else{
                $ultimo_factor = 1;
            }

            $potencias_cuadradas = $potencia / 2;
            echo "<br>potencias_cuadradas : ".$potencias_cuadradas;
            $nueva_base = $base;
            
            for ($i=0; $i < $potencias_cuadradas; $i++) { 
                $num = 1;
                $contador_sumas = 0;
                $sumatoria_impares = 0;
                while($contador_sumas < $nueva_base){
                    
                    if($num%2 != 0){
                        $sumatoria_impares += $num;
                        $contador_sumas++;
                    }
                    $num++;
                }
                $nueva_base = $sumatoria_impares;
                echo "<br>nueva_base : ".$nueva_base;
            }
            $resultado = $nueva_base * $ultimo_factor;
            return $resultado;
        }
        
        function potencia1($base, $potencia){
            $referencia = 1;
            $potenciatemp = $potencia;

            while($potenciatemp > 0){
                $potenciatemp--;
                $referencia = $referencia * $base;
            }
            return $referencia;
        }
        
    ?>
</div>


    
</body>
</html>