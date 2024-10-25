<?php

function obtenerSeleccionArmas()
{
    $respuesta = "";
    if (!isset($_POST["armamento"])) {
        $respuesta .= "SIN ARMAMENTO";
    } else {
        for ($i = 0; $i < count($_POST["armamento"]); $i++) {
            if ($i == count($_POST["armamento"]) - 2) {
                $respuesta .= $_POST["armamento"][$i] . " y ";
            } else if ($i == count($_POST["armamento"]) - 1) {
                $respuesta .= $_POST["armamento"][$i];
            } else {
                $respuesta .= $_POST["armamento"][$i] . ", ";
            }
        }
    }
    return $respuesta;
}

function procesarImagen()
{
    $imgSrc = "./calavera.png";

    if (isset($_FILES['archivo']["name"]) && $_FILES['archivo']['error'] == 0) {
        $nombreArchivo = $_FILES['archivo']['name'];
        $tipoArchivo = $_FILES['archivo']['type'];
        $tamanoArchivo = $_FILES['archivo']['size'];
        $rutaTemporal = $_FILES['archivo']['tmp_name'];

        if (is_dir("./cargas") && is_writable("./cargas") && $tamanoArchivo <= 15000 && $tipoArchivo == "image/png") {
            if (move_uploaded_file($rutaTemporal, './cargas/' . $nombreArchivo)) {
                $imgSrc = "./cargas/" . $nombreArchivo;
            }
        }
    }
    return $imgSrc;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include("captura.html");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombreJugador = trim(htmlspecialchars($_POST["nombre"]));
    $aliasJugador = trim(htmlspecialchars($_POST["alias"]));
    $edadJugador = $_POST["edad"];
    $armamentoSeleccionado = obtenerSeleccionArmas();
    $practicaMagia = (!isset($_POST["magia"]) || $_POST["magia"] != "si") ? "NO" : "SI";

    $errorImagen = false;
    $mensajeErrorImagen = false;

    if (isset($_FILES['archivo']['name'])) {
        if ($_FILES['archivo']['type'] != "image/png" || $_FILES['archivo']['size'] > 15000) {
            $errorImagen = true;
            if ($_FILES['archivo']['error'] != 4) {
                $mensajeErrorImagen = true;
            }
        }
    }

    $mensajeImagen = ($errorImagen) ? "NO se pudo subir la imagen" : "Imagen cargada";
    $imgSrc = procesarImagen();
    $mensajeError = ($mensajeErrorImagen) ? "Error al cargar la imagen" : "";

    $resultado = <<<HTML
    <div class="container">
        <h1>Ficha del Jugador</h1>
        <div class="datos">
            <p><strong>Nombre:</strong> $nombreJugador</p>
            <p><strong>Alias:</strong> $aliasJugador</p>
            <p><strong>Edad:</strong> $edadJugador</p>
            <p><strong>Armas seleccionadas:</strong> $armamentoSeleccionado</p>
            <p><strong>¿Practica magia?</strong> $practicaMagia</p>
            <p><strong>$mensajeImagen</strong></p>
            <img src="$imgSrc" alt="Imagen del jugador">
            <p>$mensajeError</p>
        </div>
    </div>
    HTML;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Generada</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
        }

        .container {
            width: 75%;
            margin: 20px auto;
            background-color: #ffeb3b;
            border-radius: 10px;
            padding: 15px;
        }

        h1 {
            text-align: center;
        }

        .datos {
            padding: 20px;
        }

        img {
            max-width: 100%;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?= (!isset($resultado) ? "" : $resultado) ?>
</body>

</html>
