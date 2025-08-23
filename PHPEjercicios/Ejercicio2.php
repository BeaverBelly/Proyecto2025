    <?php
    $ciudades =[
        ["nombre" => "New York",      "codigo" => "NY", "poblacion" => 8175133],
        ["nombre" => "Los Ángeles",   "codigo" => "CA", "poblacion" => 3792621],
        ["nombre" => "Chicago",       "codigo" => "IL", "poblacion" => 2695598],
        ["nombre" => "Houston",       "codigo" => "TX", "poblacion" => 2100263],
        ["nombre" => "Philadelphia",  "codigo" => "PA", "poblacion" => 1526006],
        ["nombre" => "Phoenix",       "codigo" => "AZ", "poblacion" => 1445632],
        ["nombre" => "San Antonio",   "codigo" => "TX", "poblacion" => 1327407],
        ["nombre" => "San Diego",     "codigo" => "CA", "poblacion" => 1307402],
        ["nombre" => "Dallas",        "codigo" => "TX", "poblacion" => 1197816],
        ["nombre" => "San José",      "codigo" => "CA", "poblacion" => 945942]
    ];

    $orden = $_GET['orden'] ?? 'nombre';
    $permitidos = ['nombre','codigo','poblacion'];
    if (!in_array($orden, $permitidos)) $orden = 'nombre';

    usort($ciudades, function ($a, $b) use ($orden) {
    if ($orden === 'poblacion') return $a['poblacion'] <=> $b['poblacion']; // numérico
    return strcasecmp($a[$orden], $b[$orden]); // texto: nombre/codigo
    });

    echo "<table>";
    
    echo "<tr>
    <th><a href= '?orden=nombre'>Ciudad</a></th>
    <th><a href= '?orden=codigo'>Código Postal</a></th>
    <th><a href= '?orden=poblacion'>Población</a></th>
    </tr>";

    foreach ($ciudades as $c) {
        echo"<tr>";
            echo "<td>{$c['nombre']}</td>";    
            echo "<td>{$c['codigo']}</td>";
            echo "<td>{$c['poblacion']}</td>";
        echo"</tr>";
    }

    echo "</table>";

?>