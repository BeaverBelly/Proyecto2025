<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Números Primos</title>
</head>
<body>
    <h1>Verificación de números primos</h1>

    <?php
    
    function primo($numero) {
        if ($numero <= 1) {
            return false; 
        }

       
        for ($i = 2; $i <= sqrt($numero); $i++) {
            if ($numero % $i == 0) {
                return false; 
            }
        }

        return true; 
    }

    
    for ($n = 1; $n <= 20; $n++) {
        if (primo($n)) {
            echo "$n es primo<br>";
        } else {
            echo "$n no es primo<br>";
        }
    }
    ?>
</body>
</html>