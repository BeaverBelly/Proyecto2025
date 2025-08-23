<?php
    $glaciares = [
        ["nombre" => "Perito Moreno", "pais" => "Argentina", "ubicacion" => "Parque Nacional Los Glaciares, Santa Cruz", "caracteristicas" => "Uno de los más famosos; equilibrio entre avance y retroceso" ],
        
        ["nombre" => "Upsala", "pais" => "Argentina", "ubicacion" => "Parque Nacional Los Glaciares, Santa Cruz", "caracteristicas" => "Gran tamaño; en retroceso" ],
        
        ["nombre" => "Pío XI (Brüggen)", "pais" => "Chile", "ubicacion" => "Campo de Hielo Sur", "caracteristicas" => "Uno de los más famosos; equilibrio entre avance y retroceso" ],
        
        ["nombre" => "San Rafael", "pais" => "Chile", "ubicacion" => "PCampo de Hielo Norte", "caracteristicas" => "Desemboca en el mar; de los más accesibles por barco" ],
        
        ["nombre" => "Chimborazo", "pais" => "Ecuador", "ubicacion" => "Volcán Chimborazo", "caracteristicas" => "Glaciar ecuatorial; punto más cercano al Sol" ],
        
        ["nombre" => "Cotopaxi", "pais" => "Ecuador", "ubicacion" => "Volcán Cotopaxi", "caracteristicas" => "Ubicado en un volcán activo; retroceso acelerado" ],
        
        ["nombre" => "Pastoruri", "pais" => "Perú", "ubicacion" => "Cordillera Oriental de los Andes", "caracteristicas" => "Campo de hielo tropical más grande del mundo" ],
        
        ["nombre" => "Quelccaya", "pais" => "Perú", "ubicacion" => "Cordillera Oriental de los Andes", "caracteristicas" => "Campo de hielo tropical más grande del mundo" ],

        ["nombre" => "Nevado del Ruiz", "pais" => "Colombia", "ubicacion" => "Volcán Nevado del Ruiz", "caracteristicas" => "Glaciar ecuatorial; en peligro de desaparecer" ],
       
        ["nombre" => "Nevado del Cocuy", "pais" => "Colombia", "ubicacion" => "Sierra Nevada del Cocuy", "caracteristicas" => "Conjunto de glaciares en retroceso" ]
    ];
    
    echo"<table border = '1'>";
    
    echo"<caption>Lista de glaciares emblemáticos de América del Sur</caption>";

    echo
        "<thead>
        <tr>
            <th>Nombre</th>
            <th>País</th>
            <th>Ubicación</th>
            <th>Características</th>
        </tr>
        </thead>";

    echo"<tbody>";

    foreach ($glaciares as $glaciar) {
        echo"<tr>";
            echo"<td>{$glaciar['nombre']}</td>";
            echo"<td>{$glaciar['pais']}</td>";
            echo"<td>{$glaciar['ubicacion']}</td>";
            echo"<td>{$glaciar['caracteristicas']}</td>";
        echo"</tr>";
    }
    
    echo"</tbody>";
    echo"</table>";

?>