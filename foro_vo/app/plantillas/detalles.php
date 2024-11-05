<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:          </td><td><?= strlen($_REQUEST['comentario']) ?></td></tr>
<tr><td>Nº de palabras:    </td><td><?=contarPalabras($_REQUEST['comentario']) ?></td></tr>
<tr><td>Letra + repetida:  </td><td><?= letraMasComun($_REQUEST['comentario']) ?></td></tr>
<tr><td>Palabra + repetida:</td><td><?=palabraMasComun($_REQUEST['comentario']) ?></td></tr>
</table>
</div>

