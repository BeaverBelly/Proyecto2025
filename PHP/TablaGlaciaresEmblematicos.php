<?php
// Encabezado para HTML y UTF-8
header('Content-Type: text/html; charset=UTF-8');

// Datos
$glaciares = [
  ["nombre" => "Perito Moreno", "pais" => "Argentina", "ubicacion" => "Parque Nacional Los Glaciares, Santa Cruz", "caracteristicas" => "Famoso por su equilibrio entre avance y retroceso"],
  ["nombre" => "Upsala", "pais" => "Argentina", "ubicacion" => "Parque Nacional Los Glaciares, Santa Cruz", "caracteristicas" => "Uno de los más grandes de Argentina; en retroceso"],
  ["nombre" => "Pío XI (Brüggen)", "pais" => "Chile", "ubicacion" => "Campo de Hielo Sur", "caracteristicas" => "El glaciar más grande de Sudamérica; con periodos de avance"],
  ["nombre" => "San Rafael", "pais" => "Chile", "ubicacion" => "Campo de Hielo Norte", "caracteristicas" => "Desemboca en el mar; accesible por barco"],
  ["nombre" => "Chimborazo", "pais" => "Ecuador", "ubicacion" => "Volcán Chimborazo", "caracteristicas" => "Glaciar ecuatorial; cumbre más cercana al Sol por abultamiento ecuatorial"],
  ["nombre" => "Cotopaxi", "pais" => "Ecuador", "ubicacion" => "Volcán Cotopaxi", "caracteristicas" => "Glaciar en volcán activo; retroceso acelerado"],
  ["nombre" => "Pastoruri", "pais" => "Perú", "ubicacion" => "Cordillera Blanca, Parque Nacional Huascarán", "caracteristicas" => "Glaciar tropical en fuerte retroceso; sitio turístico regulado"],
  ["nombre" => "Quelccaya", "pais" => "Perú", "ubicacion" => "Cordillera Oriental de los Andes", "caracteristicas" => "El campo de hielo tropical más grande del mundo"],
  ["nombre" => "Nevado del Ruiz", "pais" => "Colombia", "ubicacion" => "Volcán Nevado del Ruiz", "caracteristicas" => "Glaciar ecuatorial; en riesgo de desaparecer"],
  ["nombre" => "Nevado del Cocuy", "pais" => "Colombia", "ubicacion" => "Sierra Nevada del Cocuy", "caracteristicas" => "Conjunto de glaciares en retroceso"]
];

// Render seguro
function e($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

echo '<div class="table-responsive">';
echo '<table class="table table-striped table-hover align-middle">';
echo '<caption class="caption-top">Glaciares emblemáticos de América del Sur</caption>';
echo '<thead><tr>';
echo '<th scope="col">Nombre</th>';
echo '<th scope="col">País</th>';
echo '<th scope="col">Ubicación</th>';
echo '<th scope="col">Características</th>';
echo '</tr></thead>';

echo '<tbody>';
foreach ($glaciares as $g) {
  echo '<tr>';
  echo '<td>' . e($g['nombre']) . '</td>';
  echo '<td>' . e($g['pais']) . '</td>';
  echo '<td>' . e($g['ubicacion']) . '</td>';
  echo '<td>' . e($g['caracteristicas']) . '</td>';
  echo '</tr>';
}
echo '</tbody></table></div>';
