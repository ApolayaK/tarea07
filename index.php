<?php 
    $url = "https://jsonplaceholder.typicode.com/users"; 
    $respuesta = file_get_contents($url); 
    $usuarios = json_decode($respuesta, true); 
?> 
<!DOCTYPE html> 
<html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Usuarios - API con file_get_contents</title> 
        <link rel="stylesheet" href="estilo.css"> 
    </head> 
    <body> 
        <div class="contenedor"> 
            <h1>👤 Usuarios desde la API (GET simple)</h1> 
            <table> 
                <tr> 
                    <th>Nombre</th> 
                    <th>Email</th> 
                    <th>Ciudad</th> 
                </tr> 
                <?php foreach ($usuarios as $u): ?> 
                <tr>
                    <td><?= $u['name'] ?></td> 
                    <td><?= $u['email'] ?></td> 
                    <td><?= $u['address']['city'] ?></td> 
                </tr> 
                <?php endforeach; ?> 
            </table> 
        </div> 
    </body> 
</html>