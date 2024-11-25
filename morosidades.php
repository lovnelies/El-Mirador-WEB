<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Mirador</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/common.css">
    <style>
        .img-container {
            padding-left: 15px;
        }
    </style>
</head>
<body class="bg-dark">
    
    <?php require('inc/header.php'); ?>

    <p class="mt-5 pt-4 mb-4 text-center playwrite-gb-s-XD">Lista de deudores</p>
    <p class="mt-5 pt-4 mb-4 text-center h-font">recuerde pagar sus deudas a tiempo antes que aumenten</p>

    <div class="container">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Deuda</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Lista de nombres ficticios
                $deudores = [
                    'Segundo Valdebenito', 'Segundo Valdebenito', 'Segundo Valdebenito', 'Segundo Valdebenito', 'Segundo Valdebenito',
                    'Segundo Valdebenito', 'Segundo Valdebenito', 'Raul Ambiado', 'Raul Ambiado', 'Raul Ambiado'
                ];

                // Generar la tabla con nombres y deuda aleatoria
                foreach ($deudores as $deudor) {
                    $deuda = rand(50000, 500000); // Deuda aleatoria entre 50,000 y 500,000
                    echo "
                    <tr>
                        <td>$deudor</td>
                        <td>\$$deuda</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php require('inc/footer.php'); ?>

</body>
</html>
