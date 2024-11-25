<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['get_users'])) {
    $res = selectAll('user_cred');
    $i = 1;
    $path = USERS_IMG_PATH;

    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {
        $verified = "<span class='badge bg-warning'><i class ='bi bi-x-lg'></i></span>";

        if($row['is_verified']){
            $verified = "<span class='badge bg-success'><i class ='bi bi-check-lg'></i></span>";

        }
        $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>
        active
        </button>";

        if(!$row['status']){
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-danger btn-sm shadow-none'>
            inactive
            </button>";

        }

        $data .= "
            <tr>
                <td>$i</td>
                <td><img src='$path$row[profile]' width='55px'> 
                <br>
                $row[name]</td>
                <td>$row[email]</td>
                <td>$row[phonenum]</td>
                <td>$row[adress]</td>
                <td>$row[dob]</td>
                <td>$verified</td>
                <td>$status</td>

            </tr>
        ";
        $i++;
    }

    echo $data;
}
?>
