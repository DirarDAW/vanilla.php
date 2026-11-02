<?php
declare(strict_types=1);

 require_once __DIR__ . '/Curriculo.php';

 /**
  * Cuenta cuántos currículos hay de cada ciclo.
  *
  * @param list<Curriculo> $curriculos
  * @return array<string, int> Código del ciclo => número de currículos, en orden de aparición.
  */
 function contarPorCiclo(array $curriculos): array
 {
     $cuenta = [];
     foreach ($curriculos as $curriculo) {
         $codigo = $curriculo->ciclo->codCiclo;
         //El contador hay que ponerlo antes ++$cuenta[$codigo], si no no funciona
         $cuenta[$codigo] = isset($cuenta[$codigo]) ? ++$cuenta[$codigo] : 1;
     }

     return $cuenta;
 }

 /** Porcentaje (redondeado a entero) que representa $parte sobre $total. */
 function porcentaje(int $parte, int $total): int
 {
    //Tenemos que poner un int, hay que transformar los datos a integer para que funcione correctamente.
     return (int) (($parte / $total) * 100);
    
 }

 //Si el total equivale a 0, nos sale un error fatal (DivisionByZero), se lanza al intentar dividir un numero entre 0.
 //Protegeriamos la función validando el número que entra, que no sea cero.