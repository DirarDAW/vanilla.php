<?php
$estudiantes = ['Hanich', 'García', 'El-Khaldi'];
$buscado = 'Hanich';

for($n = 0; $n < count($estudiantes) ; $n++) {
    if ($estudiantes[$n] == $buscado) {
        echo 'Si existe dentro del array';
        break;
    }
}


