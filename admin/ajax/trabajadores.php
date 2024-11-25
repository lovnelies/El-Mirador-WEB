<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['add_trabajadores'])) {
    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "INSERT INTO `trabajadores`(`nombre`, `rut`, `telefono`, `cargo`) VALUES (?,?,?,?)";
    $values = [
        $frm_data['nombre'],
        $frm_data['rut'],
        $frm_data['telefono'],
        $frm_data['cargo'],
    ];

    if (insert($q1, $values, 'sisi')) {
        $flag = 1;
    } else {
        $flag = 0;
    }
    
    echo $flag; // Enviar 1 si la inserción fue exitosa, de lo contrario 0
}

if (isset($_POST['get_all_trabajadores'])) {
    $res = selectAll('trabajadores');
    $i = 1;
    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {

        

        $data .= "
            <tr class='align-middle'>
                <td>$i</td>
                <td>$row[nombre]</td>
                <td>$row[rut]</td>
                <td>$row[telefono]</td>
                <td>$row[cargo]</td>
                
                <td>
                    <button type='button' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-trabajadores' onclick='edit_details($row[id])'>
                        <i class='bi bi-pencil-square'></i>
                    </button>
                    <button type='button' onclick='remove_trabajadores($row[id])' class='btn btn-danger shadow-none btn-sm'>
                        <i class='bi bi-trash'></i>
                    </button>
                </td>
            </tr>
        ";

        $i++;
    }

    echo $data;
}

if (isset($_POST['get_trabajadores'])) {
    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `trabajadores` WHERE `id`=?", [$frm_data['get_trabajadores']], 'i');

    $trabajadores_data = mysqli_fetch_assoc($res1);
    $data = ["trabajadoresdata" => $trabajadores_data];

    echo json_encode($data); // Enviar datos en formato JSON
}


if (isset($_POST['toggle_status'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE `trabajadores` SET `status`=? WHERE `id`=?";
    $v = [$frm_data['value'], $frm_data['toggle_status']];

    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['remove_trabajadores'])) {
    $frm_data = filteration($_POST);

    $q = "DELETE FROM `trabajadores` WHERE `id`=?";
    $v = [$frm_data['trabajadores_id']];

    if (delete($q, $v, 'i')) {
        echo 1;
    } else {
        echo 0;
    }
}
?>
