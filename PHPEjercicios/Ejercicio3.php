<?php
    function Decimal_A_RGB($rojo, $verde,$azul){
    $r = dechex($rojo);
    $v = dechex($verde);
    $a = dechex($azul);

    $r = str_pad($r, 2, "0", STR_PAD_LEFT);
    $v = str_pad($v, 2, "0", STR_PAD_LEFT);
    $a = str_pad($a, 2, "0", STR_PAD_LEFT);

    return "#" . strtoupper($r . $v . $a);
    }

    echo Decimal_A_RGB(200, 0, 0);
?>