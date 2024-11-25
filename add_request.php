<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = filteration($_POST);

    $id_residente = $data['id_residente'];
    $tipo = $data['tipo'];
    $descripcion = $data['descripcion'];

    if (empty($id_residente) || empty($tipo) || empty($descripcion)) {
        // Si hay un error, devolver un mensaje de error en formato JSON
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios']);
        exit;
    } else {
        $sql = "INSERT INTO solicitudes (id_residente, tipo, descripcion) VALUES (?, ?, ?)";
        $values = [$id_residente, $tipo, $descripcion];
        $result = insert($sql, $values, 'sss');

        if ($result) {
            // Si la inserción es exitosa, devolver mensaje de éxito en formato JSON
            echo json_encode(['status' => 'success', 'message' => 'Solicitud ingresada correctamente']);
        } else {
            // Si hay un error al insertar, devolver mensaje de error en formato JSON
            echo json_encode(['status' => 'error', 'message' => 'Error al ingresar la solicitud']);
        }
    }
}
?>
