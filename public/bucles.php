<?php
$linea = fgets(STDIN);
$datos = explode(" ", trim($linea));
echo '<table border="solid 1px">';
for($n = 0; $n == $datos[0]; $n++){
 echo '<tr>';
   for($n = 0; $n == $datos[1]; $n++){
 	echo'<td> </td>';
 }
 echo'</tr>';
}
echo '</table>';