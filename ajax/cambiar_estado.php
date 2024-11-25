<?php
require('../inc/db_config.php');

// Verificar que se haya enviado un ID
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Obtener el estado actual de la solicitud
    $query = "SELECT estado FROM solicitudes WHERE id = ?";
    $result = select($query, [$id], 'i');
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Cambiar el estado
        $newState = ($row['estado'] === 'en revisión') ? 'resuelto' : 'en revisión';

        // Actualizar la solicitud con el nuevo estado
        $updateQuery = "UPDATE solicitudes SET estado = ? WHERE id = ?";
        $updateResult = insert($updateQuery, [$newState, $id], 'si');

        if ($updateResult) {
            echo "Estado actualizado correctamente";
        } else {
            echo "Error al actualizar el estado";
        }
    } else {
        echo "Solicitud no encontrada";
    }
} else {
    echo "ID no proporcionado";
}
?>
