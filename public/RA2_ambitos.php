<?php
  function mostrarCiclo() {
    $nombreCiclo = "Desarrollo de Aplicaciones Web";
    echo '<p>', $nombreCiclo, '</p>';
  }

  mostrarCiclo();

  $totalCicloMostrados = 0;

  function registrarVisita() {
    global $totalCicloMostrados;
    $totalCicloMostrados++;
  }

  registrarVisita();
  registrarVisita();
  registrarVisita();

  echo '<p> Ciclos mostrados: ', $totalCicloMostrados, '</p>';

  define('NOMBRE_CENTRO', 'CIFP Carlos III');

    function pie(){
        echo '<footer>', NOMBRE_CENTRO, '</footer>';
    }

    pie();

     function contadorVisitas() {
    static $visitas = 0;
    $visitas++;
    echo '<p>Visita número ', $visitas, '</p>';
  }

  contadorVisitas();   // Visita número 1
  contadorVisitas();   // Visita número 2
  contadorVisitas();   // Visita número 3
  //echo $nombreCiclo; //no funciona ya que no tenemos esa variable de manera global, esta de manera local en la funcion
  //  // Warning: Undefined variable $nombreCiclo
