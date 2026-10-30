<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST')
$contrasena2 = $_POST['contrasena2'];
$contrasena = $_POST['contrasena'];
$hashHola = password_hash($contrasena, PASSWORD_DEFAULT);
$hashHola2 = password_hash($contrasena2, PASSWORD_DEFAULT);

echo "{$hashHola} <br> {$hashHola2} "

?>