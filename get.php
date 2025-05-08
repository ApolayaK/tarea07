<?php

$url = 'http://localhost/tarea07/api/index.php';


$response = file_get_contents($url);


$recetas = json_decode($response, true);

if (empty($recetas)) {
    echo "<h3>No se encontraron recetas para mostrar.</h3>";
} else {
    echo "<h3>Recetas Disponibles</h3>";
    echo "<div class='recetas-container'>";  
    foreach ($recetas as $receta) {
        echo "<div class='receta-card'>";
        echo "<img src='" . htmlspecialchars($receta['imagen']) . "' alt='" . htmlspecialchars($receta['nombre']) . "' class='receta-img'>";
        echo "<div class='receta-content'>";
        echo "<h4>" . htmlspecialchars($receta['nombre']) . "</h4>";
        echo "<p class='descripcion'>" . htmlspecialchars($receta['descripcion']) . "</p>";
        echo "<p><strong>Precio: $</strong>" . htmlspecialchars($receta['precio']) . "</p>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
}
?>

<!-- Botón Volver -->
<div class="volver-btn-container">
    <a href="index.php" class="volver-btn">Volver a Inicio</a>
</div>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body */
body {
    font-family: 'Arial', sans-serif;
    background-color: #121212;
    color: #e0e0e0;
    line-height: 1.6;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-direction: column;
    min-height: 100vh;
    padding: 20px;
}

/* Main content */
h3 {
    text-align: center;
    font-size: 2.5rem;
    color: #ff9800;
    margin-bottom: 30px;
    font-weight: 600;
}

/* Recetas */
.recetas-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); /* Tarjetas responsivas */
    gap: 20px;
    width: 100%;
    margin-bottom: 30px;
}

.receta-card {
    background-color: #333333;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
}

.receta-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
}

.receta-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 3px solid #ff9800;
}

.receta-content {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.receta-content h4 {
    font-size: 1.4rem;
    margin-bottom: 10px;
    color: #ff9800;
    font-weight: 600;
}

.descripcion {
    font-size: 1rem;
    margin-bottom: 10px;
    color: #e0e0e0;
}

.receta-content p {
    font-size: 1.1rem;
    color: #fff;
    margin-top: auto;
}

/* Botón Volver */
.volver-btn-container {
    text-align: center;
    margin-top: 30px;
}

.volver-btn {
    background-color: #ff9800;
    color: white;
    padding: 15px 35px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.1rem;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.volver-btn:hover {
    background-color: #e67e00;
    transform: scale(1.05);
}

.volver-btn:active {
    transform: scale(0.98);
}
</style>
