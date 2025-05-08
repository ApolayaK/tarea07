<?php
header("Content-Type: application/json");

$archivo = "recetas.json";

// Verificamos si el archivo existe
if (!file_exists($archivo)) {
    file_put_contents($archivo, "[]");
}

$metodo = $_SERVER['REQUEST_METHOD'];
$datos = json_decode(file_get_contents($archivo), true);
$input = json_decode(file_get_contents("php://input"), true);

// GET → mostrar todas las recetas
if ($metodo === 'GET') {
    echo json_encode($datos);
    exit;
}

// POST → agregar nueva receta
if ($metodo === 'POST') {
    // Recibimos los datos de la receta
    $nueva = [
        "id" => time(), // ID único basado en el tiempo
        "nombre" => $_POST['nombre'] ?? $input['nombre'] ?? null,
        "imagen" => $_POST['imagen'] ?? $input['imagen'] ?? null,
        "descripcion" => $_POST['descripcion'] ?? $input['descripcion'] ?? null,
        "precio" => $_POST['precio'] ?? $input['precio'] ?? null
    ];

    // Validamos si faltan campos
    if (!$nueva['nombre'] || !$nueva['imagen'] || !$nueva['descripcion'] || !$nueva['precio']) {
        http_response_code(400);
        echo json_encode(["error" => "Faltan campos"]);
        exit;
    }

    // Agregar la nueva receta al array de recetas
    $datos[] = $nueva;
    
    // Guardamos el array actualizado en el archivo
    file_put_contents($archivo, json_encode($datos, JSON_PRETTY_PRINT));
    
    // Devolvemos la respuesta con la receta agregada
    echo json_encode(["mensaje" => "Receta agregada", "data" => $nueva]);
    exit;
}

// PUT o PATCH → actualizar receta
if (in_array($metodo, ['PUT', 'PATCH'])) {
    parse_str(file_get_contents("php://input"), $entrada);
    $id = $entrada['id'] ?? $input['id'] ?? null;

    foreach ($datos as &$receta) {
        if ($receta['id'] == $id) {
            $receta['nombre'] = $entrada['nombre'] ?? $input['nombre'] ?? $receta['nombre'];
            $receta['imagen'] = $entrada['imagen'] ?? $input['imagen'] ?? $receta['imagen'];
            $receta['descripcion'] = $entrada['descripcion'] ?? $input['descripcion'] ?? $receta['descripcion'];
            $receta['precio'] = $entrada['precio'] ?? $input['precio'] ?? $receta['precio'];
            file_put_contents($archivo, json_encode($datos, JSON_PRETTY_PRINT));
            echo json_encode(["mensaje" => "Receta actualizada", "data" => $receta]);
            exit;
        }
    }

    http_response_code(404);
    echo json_encode(["error" => "Receta no encontrada"]);
    exit;
}

// DELETE → eliminar receta
if ($metodo === 'DELETE') {
    parse_str(file_get_contents("php://input"), $entrada);
    $id = $entrada['id'] ?? $input['id'] ?? null;

    foreach ($datos as $i => $receta) {
        if ($receta['id'] == $id) {
            array_splice($datos, $i, 1);
            file_put_contents($archivo, json_encode($datos, JSON_PRETTY_PRINT));
            echo json_encode(["mensaje" => "Receta eliminada"]);
            exit;
        }
    }

    http_response_code(404);
    echo json_encode(["error" => "Receta no encontrada"]);
    exit;
}

http_response_code(405);
echo json_encode(["error" => "Método no permitido"]);
