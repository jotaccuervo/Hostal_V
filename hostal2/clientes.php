<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_db";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $sexo = $_POST['sexo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $pais = $_POST['pais'];
    $provincia = $_POST['provincia'];
    $ciudad = $_POST['ciudad'];
    $codigo_postal = $_POST['codigo_postal'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $observacion = $_POST['observacion'];

    // Preparar y ejecutar la consulta
    $sql = "INSERT INTO clientes (nombre, apellidos, dni, sexo, fecha_nacimiento, pais, provincia, ciudad, codigo_postal, direccion, telefono, observacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Vincular parámetros y ejecutar la consulta
        mysqli_stmt_bind_param($stmt, "ssssssssssss", $nombre, $apellidos, $dni, $sexo, $fecha_nacimiento, $pais, $provincia, $ciudad, $codigo_postal, $direccion, $telefono, $observacion);

        // Ejecutar la consulta y verificar el resultado
        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Cliente agregado exitosamente.</p>";
        } else {
            echo "<p>Error: " . mysqli_stmt_error($stmt) . "</p>";
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Error al preparar la consulta: " . mysqli_error($conn) . "</p>";
    }

    // Cerrar la conexión
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
</head>
<body>
    <main>
        <h2>Agregar Cliente</h2>
        <form action="" method="post">
            Nombre: <input type="text" name="nombre" required><br>
            Apellidos: <input type="text" name="apellidos" required><br>
            DNI: <input type="text" name="dni" required><br>
            Sexo: <input type="text" name="sexo"><br>
            Fecha de Nacimiento: <input type="date" name="fecha_nacimiento"><br>
            País: <input type="text" name="pais"><br>
            Provincia: <input type="text" name="provincia"><br>
            Ciudad: <input type="text" name="ciudad"><br>
            Código Postal: <input type="text" name="codigo_postal"><br>
            Dirección: <input type="text" name="direccion"><br>
            Teléfono: <input type="text" name="telefono"><br>
            Observación: <textarea name="observacion"></textarea><br>
            <input type="submit" value="Agregar Cliente">
        </form>
    </main>
</body>
</html>
