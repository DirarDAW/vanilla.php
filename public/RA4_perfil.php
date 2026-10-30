<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/RA4_comun.php';

 iniciarSesion();
 $usuario = exigirLogin();

 $mensaje = $_SESSION['mensaje'] ?? null;
 unset($_SESSION['mensaje']);

 /*
 El codigo de respuesta que tiene es 302  Found, lo que corresponde a una redirección.
 Nos lleva a RA4_login.php


 NO cambia el mensaje y queda siempre escrito el correo.

 PHPSESSID:ae7cc29f92ecd3272c99c0dc80156790
  PHPSESSID:f7b955e5e4808969baf4506086722f1b
Cambia constantemente y se regenera por temas de seguridad, si alguien obtuviera tu sessid una vez podria acceder siempre si no se regenerara.


Te quita el mensaje de bienvenida.

Si cierro sesión y le doy al boton de atras simplemente me lleva a la misma pagina como si se recargase.

Sale el rol docente.

 */
 ?>
 <!DOCTYPE html>
 <html lang="es">
 <head>
   <meta charset="UTF-8">
   <title>Mi área — <?= NOMBRE_CENTRO ?></title>
 </head>
 <body>
   <h1><?= NOMBRE_CENTRO ?> — Mi área</h1>

   <?php if ($mensaje !== null): ?>
     <p class="exito"><?= e($mensaje) ?></p>
   <?php endif; ?>

   <p>Usuario: <?= e($usuario['firstName'] . ' ' . $usuario['lastName']) ?></p>
   <p>Email: <?= e($usuario['email']) ?></p>
   <p>Rol: <?= e($usuario['rol']) ?></p>

   <form action="RA4_logout.php" method="post">
     <button type="submit">Cerrar sesión</button>
   </form>
 </body>
 </html>


 
 