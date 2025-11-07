<?php
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

$path = __DIR__ . '/../data/glaciares_demo.csv';
$data = [];

if (file_exists($path)) {
  if (($h = fopen($path, 'r')) !== false) {
    $header = fgetcsv($h); // leer cabecera
    while (($row = fgetcsv($h)) !== false) {
      $data[] = [
        'timestamp' => $row[0],
        'value' => (float)$row[1]
      ];
    }
    fclose($h);
  }
}

echo json_encode(['items' => $data], JSON_UNESCAPED_UNICODE);
