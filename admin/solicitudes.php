<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Solicitudes</title>
    <?php require('inc/links.php'); ?>
</head>
<style>
    /* Cambiar el fondo del encabezado */
    thead {
        background-color: #279e8c; /* Color oscuro */
        color: white;
    }

    /* Cambiar el fondo de las filas del cuerpo de la tabla */
    tbody tr {
        background-color: #f8f9fa; /* Color claro */
    }

    tbody tr:hover {
        background-color: #e2e6ea; /* Color al pasar el mouse sobre la fila */
    }
</style>

<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Solicitudes</h3>
                <div class="card-body">
                    <div class="text-end mb-4">
                    </div>

                    <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                        <table class="table table-hover border">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Estado</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="solicitudes-data">
                                <?php
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <?php require('inc/scripts.php'); ?>

    <script>
        function get_all_solicitudes() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/solicitudes.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('solicitudes-data').innerHTML = this.responseText;
                } else {
                    console.error('Error fetching solicitudes:', this.status);
                }
            };

            xhr.send('get_all_solicitudes=1');
        }

        function toggle_estado(id, val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/solicitudes.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status === 200) {
                    if (this.responseText.trim() === '1') {
                        alert('success', 'Estado cambiado');
                        get_all_solicitudes();
                    } else {
                        alert('error', 'Server down');
                    }
                }
            };

            xhr.send('toggle_estado=' + id + '&value=' + val);
        }


        window.onload = function() {
            get_all_solicitudes();
        };
    </script>
</body>
</html>
