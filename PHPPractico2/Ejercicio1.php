<?php
    $i = -60;
    
    echo "<table border = '1'>";

    echo "<tr><th>Celsius</th><th>Farenheith</th></tr>";
    
    while($i <= 60){
        $f = ($i * 1.8) + 32;

        echo "<tr><td>$i</td><td>$f</td></tr>";
        
        $i = $i+5;
        
    }

    echo "</table>";
?>