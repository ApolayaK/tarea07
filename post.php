<?php
$responseData = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];


    $url = 'http://localhost/tarea07/api/index.php';


    $data = [
        'nombre' => $nombre,
        'imagen' => $imagen,
        'descripcion' => $descripcion,
        'precio' => $precio
    ];


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($ch);
    curl_close($ch);


    $responseData = json_decode($response, true);
}
?>

<form method="POST" action="post.php" class="form-container">
    <h3>Agregar Nueva Receta</h3>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="imagen">Imagen (URL):</label>
    <input type="text" id="imagen" name="imagen" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required></textarea>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" required>

    <button type="submit" class="submit-btn">Agregar Receta</button>

    <a href="index.php" class="volver-btn">← Volver al Inicio</a>
</form>

<?php if ($responseData): ?>
    <pre><?php print_r($responseData); ?></pre>
<?php endif; ?>

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
    align-items: center;
    flex-direction: column;
    min-height: 100vh;
    padding: 20px;
}

/* Contenedor del formulario */
.form-container {
    background-color: #333;
    border-radius: 10px;
    padding: 20px;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
}

h3 {
    text-align: center;
    color: #ff9800;
    margin-bottom: 20px;
    font-size: 1.8rem;
    font-weight: 600;
}

label {
    font-size: 1rem;
    margin-bottom: 5px;
    display: block;
    color: #e0e0e0;
}

input, textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    background-color: #444;
    border: 1px solid #555;
    border-radius: 5px;
    color: #fff;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

input:focus, textarea:focus {
    border-color: #ff9800;
    outline: none;
}

.submit-btn {
    width: 100%;
    padding: 12px;
    background-color: #ff9800;
    border: none;
    border-radius: 10px;
    color: white;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.submit-btn:hover {
    background-color: #e67e00;
    transform: scale(1.05);
}

.submit-btn:active {
    transform: scale(0.98);
}

/* Botón Volver */
.volver-btn {
    display: block;
    margin-top: 10px;
    text-align: center;
    color: #ff9800;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.2s ease;
}

.volver-btn:hover {
    color: #ffa733;
}

/* Respuesta de la API */
pre {
    background-color: #222;
    padding: 15px;
    border-radius: 5px;
    color: #e0e0e0;
    margin-top: 20px;
    overflow: auto;
    width: 100%;
    max-width: 450px;
}

/* Responsivo */
@media (max-width: 768px) {
    .form-container {
        padding: 15px;
    }

    h3 {
        font-size: 1.6rem;
    }

    input, textarea {
        font-size: 0.95rem;
    }

    .submit-btn {
        font-size: 1rem;
    }
}
</style>
