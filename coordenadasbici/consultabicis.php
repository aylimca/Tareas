<?php
require_once 'BiciElectrica.php';

function cargarbicis() {
    $bicis = [];
    $archivo = fopen('Bicis.csv', 'r');

    while (($datos = fgetcsv($archivo)) !== false) {
        $bicis[] = new BiciElectrica($datos[0], $datos[1], $datos[2], $datos[3], $datos[4] == '1');
    }

    fclose($archivo);
    return $bicis;
}

function mostrartablabicis($bicis) {
    $tabla = "<table><tr><th>Id</th><th>Coord X<f/th><th>Coord Y</th><th>Batería</th></tr>";

    foreach ($bicis as $bici) {
        if ($bici->operativa) {
            $tabla .= "<tr><td>{$bici->id}</td><td>{$bici->coordx}</td><td>{$bici->coordy}</td><td>{$bici->bateria}%</td></tr>";
        }
    }

    $tabla .= "</table>";
    return $tabla;
}

function bicimascercana($x, $y, $bicis) {
    $biciCercana = null;
    $distanciaMinima = PHP_INT_MAX;

    foreach ($bicis as $bici) {
        if ($bici->operativa) {
            $distancia = $bici->distancia($x, $y);
            if ($distancia < $distanciaMinima) {
                $distanciaMinima = $distancia;
                $biciCercana = $bici;
            }
        }
    }

    return $biciCercana;
}


$tabla = cargarbicis();
if (!empty($_GET['coordx']) && !empty($_GET['coordy'])) {
    $biciRecomendada = bicimascercana($_GET['coordx'], $_GET['coordy'], $tabla);
}

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>MOSTRAR BICIS OPERATIVAS</title>
<style>
table, th, td {
border: 1px solid black;
}
</style>

</head>

<body>
<h1> Listado de bicicletas operativas </h1>
<?= mostrartablabicis($tabla); ?>
<?php if (isset($biciRecomendada)) : ?>
<h2> Bicicleta disponible más cercana es <?= $biciRecomendada ?> </h2>
<button onclick="history.back()"> Volver </button>
<?php else : ?>
<h2> Indicar su ubicación: </h2>
<form>
Coordenada X: <input type="number" name="coordx"><br>
Coordenada Y: <input type="number" name="coordy"><br>
<input type="submit" value=" Consultar ">
</form>
<?php endif ?>
</body>

</html>
