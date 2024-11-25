<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Pagos</title>
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
                <h3 class="mb-4">Pagos</h3>
                <div class="card-body">
                    <div class="text-end mb-4">
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-event-modal">
                            <i class="bi bi-plus-square"></i> Añadir Pago
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover border text-center" style="width: 100%">
                            <thead>
                                <tr >
                                    <th scope="col">id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col"></th>
                                    
                                </tr>
                            </thead>
                            <tbody id="pagos-data">
    <?php
    require('inc/db_config.php');

    // Obtener los pagos desde la base de datos
    $query = "SELECT * FROM pagos";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '<td>' . $row['valor'] . '</td>';
            echo '<td>' . $row['fecha'] . '</td>';
            echo '<td>';
            echo '<a href="informe_pago.php?id=' . $row['id'] . '" class="btn btn-dark shadow-none btn-sm">Informe</a>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="5">No hay pagos registrados.</td></tr>';
    }
    ?>
</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para añadir pagos -->
    <div class="modal fade" id="add-event-modal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="add_pago_form" method="POST" action="pagos_handler.php" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Añadir Pago</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Nombre</label>
                                <input type="text" name="nombre" class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Valor</label>
                                <input type="number" name="valor" class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Fecha de pago</label>
                                <input type="date" name="fecha" class="form-control shadow-none" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark shadow-none">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>
</body>
</html>
