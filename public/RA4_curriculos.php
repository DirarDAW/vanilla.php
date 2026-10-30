<?php
declare(strict_types=1);

 require_once __DIR__ . '/../src/RA4_comun.php';

 session_start([
     'cookie_httponly' => true,
     'cookie_samesite' => 'Lax',
 ]);

 $validador = new ValidadorCurriculo(catalogoCiclos());

 // Reconstruimos cada currículo de la sesión; su id es su posición + 1.
 $curriculos = [];
 foreach ($_SESSION['curriculos'] ?? [] as $posicion => $datos) {
     $curriculos[] = $validador->crearCurriculo($datos, $posicion + 1);
 }

 // Mensaje flash: se muestra una vez y se borra de la sesión.
 $mensaje = $_SESSION['mensaje'] ?? null;
 unset($_SESSION['mensaje']);



/*
303 See Other, ese es el codigo de estado que tiene 

Set-Cookie: 
ultimo_ciclo=DAW; expires=Sun, 29 Nov 2026 11:10:03 GMT; Max-Age=2592000; HttpOnly; SameSite=Lax

Location: 
RA4_curriculos.php

Viene una petición: http://localhost/RA4_curriculos.php
Esta petición es de método get.

Ni me pregunta si quiero volver a reenviar el formulario y el mensaje desaparece.

Aparece el cilo DAW, la cookie con fecha de caducidad es la cookie de ultimo ciclo, mientras que la de session es PHPSESSID.

No sale ningun curriculo, la cookie no se mantiene en la de incognita.
 
Cuando borras la sesion y reinicias, no sale ningun curriculo, se borran todos. 
NO se almacena en servidor, la estamos borrando.

 1. Diferencias principales con las cookies:
 Capacidad: Las cookies se limitan a unos 4 KB, mientras que Web Storage ofrece entre 5 MB y 10 MB.
 Persistencia: sessionStorage se borra al cerrar la pestaña, localStorage es indefinido,
 y las cookies dependen de su fecha de expiración.

Web Storage tiene una API de JavaScript limpia
a diferencia de la cadena de document.cookie.

¿Recibe el servidor su contenido en cada petición?
NO, Las cookies se envían automáticamente en cada cabecera HTTP, lo que consume ancho de banda. Los datos de Web Storage son estrictamente locales y se quedan en el navegador; el servidor nunca los recibe a menos que los envíes tú manualmente por código.

¿Sirve para guardar el identificador de sesión de forma segura usando HttpOnly?
NO, La flag httponly es exclusiva de las cookies e impide que JavaScript acceda a ellas,
protegiéndolas de ataques XSS (inyección de código). Como Web Storage es 100% accesible por JavaScript,
cualquier script malicioso podría robar el identificador de sesión instantáneamente. 
Para datos críticos entre otras cosas, se deben seguir usando cookies HttpOnly.

*/

 ?>
 <!DOCTYPE html>
 <html lang="es">
 <head>
   <meta charset="UTF-8">
   <title>Currículos — <?= NOMBRE_CENTRO ?></title>
 </head>
 <body>
   <h1><?= NOMBRE_CENTRO ?> — Currículos</h1>

   <?php if ($mensaje !== null): ?>
     <p class="exito"><?= e($mensaje) ?></p>
   <?php endif; ?>

   <?php if ($curriculos === []): ?>
     <p>Todavía no has dado de alta ningún currículo.</p>
   <?php else: ?>
     <ul>
       <?php foreach ($curriculos as $curriculo): ?>
         <li>
           <?= e($curriculo->id . '. ' . $curriculo->descripcion()) ?>
           <?php if ($curriculo->videoCurriculum !== null): ?>
             — <a href="<?= e($curriculo->videoCurriculum) ?>">ver vídeo</a>
           <?php endif; ?>
         </li>
       <?php endforeach; ?>
     </ul>
   <?php endif; ?>

   <p><a href="RA4_altaCurriculo.php">Dar de alta un currículo</a></p>
 </body>
 </html>