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

RESPUESTA: SEGURIDAD EN LA IMPLEMENTACIÓN DE LA CASILLA "RECORDARME"

1. ¿Por qué NO se guardan el email y la contraseña en una cookie?
Almacenar las credenciales directas en el cliente es un riesgo crítico de seguridad. 
Si un atacante consigue acceso físico al equipo, sufre un ataque de malware o explota una vulnerabilidad XSS, 
obtendría la contraseña real del usuario. Esto comprometería no solo la sesión actual, sino la cuenta completa 
y cualquier otro servicio externo donde el usuario repita esa misma contraseña.

2. ¿Cómo se implementa de forma segura? (Estrategia de Token Permanente)
En lugar de credenciales, se utiliza un sistema de tokens aleatorios de un solo uso de la siguiente manera:

En el Cliente (Cookie):
Cuando el usuario marca "Recordarme", el servidor genera un token aleatorio criptográficamente fuerte. Este token se envía al navegador y se almacena en una cookie con los atributos de seguridad HttpOnly (invisible para JavaScript), Secure (solo viaja por HTTPS) y SameSite (mitiga CSRF).
En el Servidor (Base de datos):
El servidor nunca guarda el token tal cual. Siguiendo el principio de las contraseñas, calcula el HASH del token (por ejemplo, usando SHA-256 o bcrypt) y almacena ese hash asociado al ID del usuario. De este modo, si la base de datos del servidor se filtra, los atacantes no obtendrán los tokens válidos.



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


 
 