<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['add_residentes'])) {
    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "INSERT INTO `residentes`(`nombre`, `rut`, `telefono`, `cargo`, `residencia`) VALUES (?,?,?,?,?)";
    $values = [
        $frm_data['nombre'],
        $frm_data['rut'],
        $frm_data['telefono'],
        $frm_data['cargo'],
        $frm_data['residencia']
    ];

    if (insert($q1, $values, 'siii')) {
        $flag = 1;
    } else {
        $flag = 0;
    }
    
    echo $flag; // Enviar 1 si la inserción fue exitosa, de lo contrario 0
}

if (isset($_POST['get_all_residentes'])) {
    $res = selectAll('residentes');
    $i = 1;
    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {

        

        $data .= "
            <tr class='align-middle'>
                <td>$i</td>
                <td>$row[nombre]</td>
                <td>$row[rut]</td>
                <td>$row[telefono]</td>
                <td>$row[residencia]</td>
                
                <td>
                    <button type='button' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-residentes' onclick='edit_details($row[id])'>
                        <i class='bi bi-pencil-square'></i>
                    </button>
                    <button type='button' onclick='remove_residentes($row[id])' class='btn btn-danger shadow-none btn-sm'>
                        <i class='bi bi-trash'></i>
                    </button>
                </td>
            </tr>
        ";

        $i++;
    }

    echo $data;
}

if (isset($_POST['get_residentes'])) {
    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `residentes` WHERE `id`=?", [$frm_data['get_residentes']], 'i');

    $residentes_data = mysqli_fetch_assoc($res1);
    $data = ["residentesdata" => $residentes_data];

    echo json_encode($data); // Enviar datos en formato JSON
}


if (isset($_POST['toggle_status'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE `residentes` SET `status`=? WHERE `id`=?";
    $v = [$frm_data['value'], $frm_data['toggle_status']];

    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['remove_residentes'])) {
    $frm_data = filteration($_POST);

    $q = "DELETE FROM `residentes` WHERE `id`=?";
    $v = [$frm_data['residentes_id']];

    if (delete($q, $v, 'i')) {
        echo 1;
    } else {
        echo 0;
    }
}
?>
