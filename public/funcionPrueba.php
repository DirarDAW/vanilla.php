<?php
   function sumarN(array $n): string {
    $resultado = 0;
    for($i = 0; $i < count($n); $i++){
        $resultado += $n[$i];
    }
    return $resultado;
    }

    function mediaN(array $n): string {
        $resultado = sumarN($n)/count($n);
        return $resultado;
    }
while($linea = fgets(STDIN)): 
$datos = explode(" ", trim($linea));
$operando = $datos[0];
$n = array_slice($datos, 1);
if(count($n) < 2): ?>
<p>(Error) No dispongo de suficientes argumentos.</p>
<?php elseif ($operando === 'suma'): ?>
<p>La suma de los números es: <?= sumarN($n);?></p>
<?php
elseif ($operando === 'media'): ?>
<p>La media de los números es: <?= mediaN($n);?></p>
<?php elseif($operando != 'suma' || $operando != 'media' ) :?>
<p>(Error) Operación no permitida</p>
<?php endif; ?>
<?php endwhile; ?>