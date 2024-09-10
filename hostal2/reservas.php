<?php  //primera parte conexion bd 
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
?>
 
<main>
    <h2>Agregar Reserva</h2> 
    <form action="" name="reservas" method="post">
        Número de Habitación: <input type="text" name="num_habitacion" required><br>
        Fecha de Entrada: <input type="date" name="fecha_entrada" required><br>
        Fecha de Salida: <input type="date" name="fecha_salida" required><br>
        Precio: <input type="number" name="precio" required><br>
        Observación: <textarea name="observacion"></textarea><br>
        <input type="submit" value="AgregarReserva">
    </form>
</main>

<?php
// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $num_habitacion = $_POST['num_habitacion'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $precio = $_POST['precio'];
    $observacion = $_POST['observacion'];

    // Preparar y ejecutar la consulta
    $sql = "INSERT INTO reservas (num_habitacion, fecha_entrada, fecha_salida, precio, observacion) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Vincular parámetros y ejecutar la consulta
        mysqli_stmt_bind_param($stmt, "sssss", $num_habitacion, $fecha_entrada, $fecha_salida, $precio, $observacion);

        // Ejecutar la consulta y verificar el resultado
        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Reserva agregada exitosamente.</p>";
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

