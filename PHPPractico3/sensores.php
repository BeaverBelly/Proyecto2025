<?php
$sensores = ["temperatura", "humedad", "presion"];

$valores = [];

foreach ($sensores as $sensor) {
    if (isset($_POST[$sensor]) && $_POST[$sensor] !== "") {
        $valores[$sensor] = htmlspecialchars($_POST[$sensor]); 
    } else {
        $valores[$sensor] = "No recibido";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $datos_guardar = date("Y-m-d H:i:s") . PHP_EOL;
    foreach ($sensores as $sensor) {
        $datos_guardar .= ucfirst($sensor) . ": " . $valores[$sensor] . PHP_EOL;
    }
    $datos_guardar .= str_repeat("-", 20) . PHP_EOL;

    file_put_contents("sensores.txt", $datos_guardar, FILE_APPEND);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos de Sensores</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; text-align: center; }
        table {
            border-collapse: collapse;
            width: 40%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background: #f2f2f2;
        }
        form {
            margin: 20px auto;
            width: 40%;
            text-align: left;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
        }
        label { display: block; margin-bottom: 10px; }
        input { width: 100%; padding: 6px; }
        button { margin-top: 10px; padding: 8px 15px; }
        pre {
            text-align: left;
            background: #f9f9f9;
            padding: 10px;
            border: 1px solid #ccc;
            width: 40%;
            margin: auto;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <h2>Lectura de Sensores</h2>

    <form method="post" action="">
        <label>Temperatura (°C): <input type="text" name="temperatura"></label>
        <label>Humedad (%): <input type="text" name="humedad"></label>
        <label>Presión (hPa): <input type="text" name="presion"></label>
        <button type="submit">Enviar datos</button>
    </form>

    <table>
        <tr>
            <th>Sensor</th>
            <th>Valor</th>
        </tr>
        <?php foreach ($valores as $sensor => $valor): ?>
            <tr>
                <td><?php echo ucfirst($sensor); ?></td>
                <td><?php echo $valor; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Histórico de lecturas (archivo sensores.txt)</h3>
    <pre>
<?php
    if (file_exists("sensores.txt")) {
        echo htmlspecialchars(file_get_contents("sensores.txt"));
    } else {
        echo "Todavía no hay datos guardados.";
    }
?>
    </pre>
</body>
</html>