<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Fibonacci</title>
</head>
<body>
    

    <?php
   
    function fibonacci($n) {
        $secuencia = [];

        if ($n <= 0) {
            return $secuencia;
        }

        
        $secuencia[0] = 0;

        if ($n > 1) {
            $secuencia[1] = 1;
        }

    
        for ($i = 2; $i < $n; $i++) {
            $secuencia[$i] = $secuencia[$i - 1] + $secuencia[$i - 2];
        }

        return $secuencia;
    }

    
    $cantidades = [5, 10, 15];

    foreach ($cantidades as $cantidad) {
        $resultado = fibonacci($cantidad);
        echo "<h3>Fibonacci con $cantidad elementos:</h3>";
        echo implode(", ", $resultado);
        echo "<hr>";
    }
    ?>
</body>
</html>