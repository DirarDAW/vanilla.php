<?php
  $visitas = 0;
  
  function contadorVisitas() {
    global $visitas;
    $visitas++;
    echo '<p>Visita número ', $visitas, '</p>';
  }
 
  contadorVisitas();   // Visita número 1
  contadorVisitas();   // Visita número 2
  contadorVisitas();   // Visita número 3
?>