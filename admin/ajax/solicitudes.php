<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();


if (isset($_POST['get_all_solicitudes'])) {
    $res = selectAll('solicitudes');
    $i = 0;
    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {

        if ($row['estado'] == 1) {
            $estado = "<button onclick='toggle_estado($row[id],0)' class='btn btn-dark btn-sm shadow-none'>En revisión</button>";
        } else {
            $estado = "<button onclick='toggle_estado($row[id],1)' class='btn btn-warning btn-sm shadow-none'>Resuelto</button>";
        }

        $data .= "
            <tr class='align-middle'>
                <td>$i</td>
                <td>$row[id]</td>
                <td>$row[tipo]</td>
                <td>$row[descripcion]</td>
                <td>$estado</td>          
            </tr>
        ";

        $i++;
    }

    echo $data;
}

if (isset($_POST['get_solicitudes'])) {
    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `solicitudes` WHERE `id`=?", [$frm_data['get_solicitudes']], 'i');

    $solicitudes_data = mysqli_fetch_assoc($res1);
    $data = ["solicitudesdata" => $solicitudes_data];

    echo json_encode($data); // Enviar datos en formato JSON
}


if (isset($_POST['toggle_estado'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE `solicitudes` SET `estado`=? WHERE `id`=?";
    $v = [$frm_data['value'], $frm_data['toggle_estado']];

    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}


?>
