<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Dados Aleatorios</title>
    <style>
        .jugador {
            display: inline-block;
            font-size: 20px;
            font-weight: bold;
            height: 70px;
        }

        .dados {
            font-size: 40px;
            font-weight: 400;
            padding-top: 15px;
            padding-bottom: 10px;
        }

        .dados1 {
            background-color: red;
        }

        .dados2 {
            background-color: blue;
        }

        span {
            font-weight: bold;
        }

    </style>
</head>

<body>

    <?php

    $carasDados = [
        1 => "&#9856;",
        2 => "&#9857;",
        3 => "&#9858;",
        4 => "&#9859;",
        5 => "&#9860;",
        6 => "&#9861;"
    ];

    $resultadoPartida = ["Empate", "Ganó el Jugador 1", "Ganó el Jugador 2"];

    $jugador1Dados = [];
    $jugador2Dados = [];
    $puntuacion1 = 0;
    $puntuacion2 = 0;


    function generarTirada($carasDados, &$puntuacion): array
    {
        $tirada = [];
        $puntuacionMax = PHP_INT_MIN;
        $puntuacionMin = PHP_INT_MAX;

        for ($i = 0; $i < count($carasDados); $i++) {
            $numeroAleatorio = array_rand($carasDados);
            
            $puntuacion += $numeroAleatorio;

            if ($numeroAleatorio > $puntuacionMax) {
                $puntuacionMax = $numeroAleatorio;
            }
            if ($numeroAleatorio < $puntuacionMin) {
                $puntuacionMin = $numeroAleatorio;
            }

            $tirada[] = $carasDados[$numeroAleatorio];
        }

        $puntuacion -= $puntuacionMin;
        $puntuacion -= $puntuacionMax;
        return $tirada;
    }


    function mostrarTirada($tirada): string
    {
        $resultado = "";
        foreach ($tirada as $cara) {
            $resultado .= $cara;
        }
        return $resultado;
    }

    function determinarGanador($resultadoPartida, $puntuacion1, $puntuacion2): int
    {
        if ($puntuacion1 == $puntuacion2) {
            return 0;
        } elseif ($puntuacion1 > $puntuacion2) {
            return 1;
        } else {
            return 2;
        }
    }

    $jugador1Dados = generarTirada($carasDados, $puntuacion1);
    $jugador2Dados = generarTirada($carasDados, $puntuacion2);
    
    ?>

    <h1>Juego de Dados</h1>
    <p>Actualiza la página para realizar una nueva tirada</p>
    <div class="jugador">
        Jugador 1
        <span class="dados1 dados"><?= mostrarTirada($jugador1Dados) ?></span>
        <?= $puntuacion1 ?> puntos
    </div>
    <br>
    <div class="jugador">
        Jugador 2
        <span class="dados2 dados"><?= mostrarTirada($jugador2Dados) ?></span>
        <?= $puntuacion2 ?> puntos
    </div>
    <p><span>Resultado:</span> <?= $resultadoPartida[determinarGanador($resultadoPartida, $puntuacion1, $puntuacion2)] ?></p>

</body>

</html>
