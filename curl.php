<?php 

$ch = curl_init("https://jsonplaceholder.typicode.com/users"); 
curl_setopt_array($ch, [ CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => ['Content-Type: application/json'] ]); 
$respuesta = curl_exec($ch); curl_close($ch); $usuarios = json_decode($respuesta, true); 
?> 

<!DOCTYPE html> 
<html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Usuarios - API con cURL</title> 
        <link rel="stylesheet" href="estilo.css"> 
    </head> 
    <body> 
        <div class="contenedor"> 
            <h1>🌐 Usuarios desde la API (cURL)</h1> 
            <table> 
                <tr> 
                    <th>Nombre</th> 
                    <th>Email</th> 
                    <th>Teléfono</th> 
                </tr> 
                <?php foreach ($usuarios as $u): ?> 
                <tr> 
                    <td><?= $u['name'] ?></td> 
                    <td><?= $u['email'] ?></td> 
                    <td><?= $u['phone'] ?></td> 
                </tr> 
                <?php endforeach; ?> 
            </table> 
        </div> 
    </body> 
</html>