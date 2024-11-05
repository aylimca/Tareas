<?php
function usuarioOk($usuario, $contraseña) :bool {
   return (strlen($usuario)>= 8 && $usuario == strrev($contraseña));
}

function contarPalabras($texto): int {
   if($texto == "") {
       return 0;
   }
   $texto = trim($texto);
   $palabras = explode(" ", $texto);

   return sizeof($palabras);
}

function letraMasComun($texto): string {
   if($texto == "") {
       return "N/A";
   }
   $texto = strtolower($texto);
   $letras = str_split($texto);
   $contador = array_count_values($letras);
   arsort($contador);

   $letraComuna = array_keys($contador);
   return $letraComuna[0];
}

function palabraMasComun($texto): string {
   $palabras = explode(" ", $texto);
   $contadorPalabras = array_count_values($palabras);
   $masFrecuente = array_search(max($contadorPalabras), $contadorPalabras);

   return $masFrecuente;
}
?>

