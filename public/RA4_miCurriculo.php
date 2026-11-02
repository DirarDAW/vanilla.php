<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/RA4_comun.php';


//funcion de RA4_comun.php, abrir o retomar sesión.
 iniciarSesion();

 //nos exigen ser alumnos o NO se entra
 $usuario = exigirRol('alumno');


 //Crea el catalogo de ciclos disponibles como un array.
 $ciclos    = catalogoCiclos();
 $validador = new ValidadorCurriculo($ciclos);
 //El nombre debe ser el guardado en la sesión, no el del formulario para que no entre cualquiera a traves de el.
 $nombre    = $usuario['firstName'] . ' ' . $usuario['lastName'];
 $errores   = [];

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // El alumno sale de la sesión, nunca del formulario: cada uno, solo su currículo.
     $datos = [
         //El nombre debe ser el guardado en la sesión, no el del formulario para que no entre cualquiera a traves de el.
         'alumno' => $nombre,
         'ciclo'  => $_POST['ciclo'] ?? '',
         'video'  => $_POST['video'] ?? '',
     ];
     $errores = $validador->validar($datos);

     if ($errores === []) {
         $guardado = $validador->crearCurriculo($datos, 1);
         $_SESSION['curriculo'] = [
             'alumno' => $guardado->alumno,
             'ciclo'  => $guardado->ciclo->codCiclo,
             'video'  => $guardado->videoCurriculum ?? '',
         ];
         $_SESSION['mensaje'] = 'Currículo guardado.';

         header('Location: RA4_miCurriculo.php', true, 303);
         exit;
     }
 } else {
     // Al editar, el formulario parte de lo guardado.
     $datos = $_SESSION['curriculo'] ?? ['alumno' => $nombre, 'ciclo' => '', 'video' => ''];
 }

 // Uno por alumno, como User y Curriculo en la aplicación: el id siempre es 1.
 $curriculo = isset($_SESSION['curriculo'])
     ? $validador->crearCurriculo($_SESSION['curriculo'], 1)
     : null;

 // Formulario si no hay currículo, si se ha pedido editar o si hay errores que mostrar.
 $editando = $curriculo === null || isset($_GET['editar']) || $errores !== [];

 $mensaje = $_SESSION['mensaje'] ?? null;
 unset($_SESSION['mensaje']);

 /*Aparece ana lopez, el nombre de alumno, esto es porque no recoge el nombre mediante formulario, si no por la sesion
 que tiene guardada ($usuario)
 
 Al cerrar sesión y volver a entrar con el mismo usuario, entro a mi curriculo y aparece que no tengo ningun curriculo,
 tengo que elegir grado de nuevo.
 Solución -->  Para que el currículo sobreviva al cierre de sesión y lo puedan consultar otros usuarios,
necesitamos guardarlo en un sitio compartido y permanente: la base de datos, en el Bloque 6.

 No, no se ve el enlace en su perfil, el mensaje de estado es 'No tienes permiso para ver esta página.' correspondiente
 a la función exigirRol(), en su salida exit().
 Su codigo de estado es 403 Forbidden(Prohibido).

 401 Unauthorized --> No estas autenticado, no puedes entrar a la página sin antes demostrar quien eres y ahi se hara la verificación
         de si tienes permitido pasar.
 403 Forbidden --> Acceso prohibido, ya te has autenticado, le has enseñado a la página tu 'Rol' y te dicen que definitivamente no
        puedes entrar. Prohibida la entrada.


 Tendríamos que añadir un campo a Curriculo.php que es donde se crea la clase de los curriculos, necesitaría una nueva
 propiedad ÚNICA, para identificar a cada uno (user_id).
 Para que un docente pueda ver los curriculos, los deberiamos de guardar en una base de datos, verificar que la entrada 
 sea un administrador y si lo es, mostrarle los curriculos.
 */

 ?>
 <!DOCTYPE html>
 <html lang="es">
 <head>
   <meta charset="UTF-8">
   <title>Mi currículo — <?= NOMBRE_CENTRO ?></title>
 </head>
 <body>
   <h1><?= NOMBRE_CENTRO ?> — Mi currículo</h1>

   <?php if ($mensaje !== null): ?>
     <p class="exito"><?= e($mensaje) ?></p>
   <?php endif; ?>

   <?php if (!$editando): ?>
     <p><?= e($curriculo->descripcion()) ?></p>
     <p>Ciclo: <?= e($curriculo->ciclo->nombre) ?> — titulación de <?= e($curriculo->ciclo->titulacion()) ?></p>
     <p>Vídeo:
       <?php if ($curriculo->videoCurriculum !== null): ?>
         <a href="<?= e($curriculo->videoCurriculum) ?>">ver vídeo</a>
       <?php else: ?>
         sin vídeo
       <?php endif; ?>
     </p>
     <p><a href="RA4_miCurriculo.php?editar=1">Editar mi currículo</a></p>
   <?php else: ?>
     <?php if ($curriculo === null): ?>
       <p>Todavía no tienes currículo: rellena el formulario para darlo de alta.</p>
     <?php endif; ?>

     <?php if ($errores !== []): ?>
       <ul class="errores">
         <?php foreach ($errores as $error): ?>
           <li><?= e($error) ?></li>
         <?php endforeach; ?>
       </ul>
     <?php endif; ?>

     <form action="RA4_miCurriculo.php" method="post">
       <p>Alumno: <?= e($nombre) ?></p>
       <p>
         <label>Ciclo
           <select name="ciclo">
             <option value="">— Elige un ciclo —</option>
             <?php foreach ($ciclos as $codigo => $ciclo): ?>
               <option value="<?= e($codigo) ?>" <?= ($datos['ciclo'] ?? '') === $codigo ? 'selected' : '' ?>><?= e($ciclo->descripcion()) ?></option>
             <?php endforeach; ?>
           </select>
         </label>
       </p>
       <p>
         <label>Vídeo de presentación (opcional)
           <input name="video" type="url" value="<?= e($datos['video'] ?? '') ?>">
         </label>
       </p>
       <button type="submit">Guardar</button>
     </form>
   <?php endif; ?>

   <p><a href="RA4_perfil.php">Volver a mi área</a></p>
 </body>
 </html>

 