<?php

    

define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/hbwebsite/images/');
define('ABOUT_FOLDER','about/');
define('USERS_FOLDER','users/');
define('SITE_URL','http://127.0.0.1/hbwebsite/');
define('USERS_IMG_PATH', 'users/images');
define('RIGHT_PATH','C:/xampp/htdocs/HBWEBSITE/images/restaurant/');


define('SENDGRID_API_KEY',"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");





function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
            echo"<script>
                window.location.href='index.php';
            </script>";
        }
        session_regenerate_id(true);

    }


    function redirect($url){
        echo"<script>
        window.location.href='$url';
        </script>";
    }


    function alert($type, $msg){

        $bs_class = ($type == "success") ? "alet-success" : "alert-danger";

        echo <<<alert
                <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
                    <strong class="me-3">$msg</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                alert;
    }

// essentials.php


function selectAll($table) {
    global $con;
    $query = "SELECT * FROM $table";
    $result = mysqli_query($con, $query);
    return $result;
}

// En db_config.php o un archivo similar

function delete($sql, $values, $datatypes) {
    global $con;
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - delete");
        }
    } else {
        die("Query cannot be prepared - delete");
    }
}


function uploadUserImage($image)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp']; 
    $img_mime = $image['type'];

    if(!in_array($img_mime, $valid_mime)){
        return 'inv_img'; 
    }
    else{
    $ext = pathinfo($image['name'], PATHINFO_EXTENSION); 
    $rname = 'IMG_'.random_int(11111,99999).".jpeg";

    $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

    if($ext == 'png' || $ext == 'PNG'){
        $img = imagecreatefrompng($image['tmp_name']);
    }
    else if($ext == 'webp' || $ext == 'WEBP'){
        $img = imagecreatefromwebp($image['tmp_name']);
    }
    else{
        $img = imagecreatefromjpeg($image['tmp_name']);

    }

    if(imagejpeg($img,$img_path,75)){
        return $rname;
    }
    else{
        return 'upd_failed';
    }
 } 
}


function obtenerNombreHabitacion($room_id, $conn) {
    $sql = "SELECT name FROM rooms WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->fetch();
    $stmt->close();
    return $name;
}




?>