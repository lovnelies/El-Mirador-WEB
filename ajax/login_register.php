<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');
require("../inc/sendgrid/sendgrid-php.php");
session_start();

if (isset($_SESSION['userLogin']) && $_SESSION['userLogin'] == true) {
    redirect('rooms.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Verificar credenciales (debes implementar esto según tu lógica de autenticación)
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Aquí deberías hacer la validación de usuario en tu base de datos o sistema de autenticación

    if ($email == 'usuario@example.com' && $password == 'contraseña') {
        // Inicio de sesión exitoso
        session_start();
        $_SESSION['user_logged_in'] = true;
        echo 'login_success';
    } else {
        // Inicio de sesión fallido
        echo 'login_failed';
    }
} else {
    // Si no es una solicitud POST válida
    echo 'error'; // Podrías manejar esto de manera diferente según necesites
}

function send_mail($uemail, $name, $token)
{
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("caenlashojitas@gmail.com", "YUWIWI");
    $email->setSubject("VERIFICACION");

    $email->addTo($uemail, $name);

    $email->addContent(
        "text/html",
        "
        CONFIRMA <br>
        <a href='" . SITE_URL . "email_confirm.php?email=$uemail&token=$token" . "'>
        AKI
        </a>
        "
    );
    $sendgrid = new \SendGrid('SENDGRID_API_KEY');
    try {
        $sendgrid->send($email);
        return 1;
    } catch (Exception $e) {
        return 0;
    }
}

if (isset($_POST['register'])) {
    $data = filteration($_POST);

    // Coincidir contraseñas
    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    // Verificar si el usuario ya existe
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`= ? OR `phonenum`=? LIMIT 1", 
                      [$data['email'], $data['phonenum']], "ss");

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    // Subir imagen al servidor (opcional)
    $img = '';
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == UPLOAD_ERR_OK) {
        $img = uploadUserImage($_FILES['profile']);
        if ($img == 'inv_img') {
            echo 'inv_img';
            exit;
        } else if ($img == 'upd_failed') {
            echo 'upd_failed';
            exit;
        }
    }

    // Insertar datos del usuario en la base de datos
    $q = "INSERT INTO `user_cred`(`name`, `email`, `phonenum`, `adress`, `pincode`, `dob`, `password`, `profile`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $values = [$data['name'], $data['email'], $data['phonenum'], $data['adress'], $data['pincode'], $data['dob'], $data['pass'], $img];

    $result = insert($q, $values, 'ssssssss');
    if ($result) {
        echo 'success';
    } else {
        echo 'mail_failed';
    }
    exit;
}
?>
