<?php
    function esPrimo(int $numero){
        if($numero <= 1){
            return false;
        }

    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) {
            return false; // Encontró un divisor
        }
    }
    return true; // No encontró divisores, es primo
}


$num = 7;
for ($i = 0; $i < 20; $i++)
if (esPrimo($i)) {
    echo "$i es primo <br>";
} else {
    echo "$i no es primo<br>";
}

?>