
<?php 
function factoresPrimos(int $n): array{
$x = 2;
$contador = 0;
$numeros = [];
while($n != 1):
    if($n % $x == 0): 
     $n = $n / $x;
     $numeros[$contador] = $x;
     $contador++;
    else:
        $x = $x + 1;
    endif;
endwhile;
return $numeros;
}
function imprimeFactoresPrimos($numeros) {
$contar = array_count_values($numeros);
$mensaje = [];
 foreach ($contar as $exp => $valor):
 $mensaje[] = $exp. ' ^ '. $valor;
 print_r($mensaje);
 echo implode(" * ", $mensaje);
 
endforeach;

}
while($numero = factoresPrimos(fgets(STDIN))): ?>
<?php echo imprimeFactoresPrimos($numero)?>
<?php endwhile;?>
