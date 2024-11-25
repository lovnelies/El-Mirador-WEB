<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Residentes</title>
    <?php require('inc/links.php'); ?>
</head>
<style>
    /* Cambiar el fondo del encabezado */
    thead {
        background-color: #279e8c ; /* Color oscuro */
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
                <h3 class="mb-4">Residentes</h3>
                <div class="card-body">
                    <div class="text-end mb-4">
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-residentes-modal">
                            <i class="bi bi-plus-square"></i> Añadir
                        </button>
                    </div>

                    <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                        <table class="table table-hover border">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">nombre</th>
                                    <th scope="col">rut</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">residencia</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="residentes-data">
                                <?php
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD residentes MODAL -->
    <div class="modal fade" id="add-residentes-modal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="add_residentes_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Añadir Residente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">nombre</label>
                                <input type="text" name="nombre" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">rut</label>
                                <input type="number" min="1" name="rut" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">telefono</label>
                                <input type="number" min="1" name="telefono" class="form-control shadow-none" required>
                            </div>                   
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">residencia </label>
                                <input type="text" min="1" name="residencia" class="form-control shadow-none" required>
                            </div>                       
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT residentes MODAL -->
    <div class="modal fade" id="edit-residentes-modal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="edit_residentes_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit residentes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">nombre</label>
                                <input type="text" name="nombre" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">rut</label>
                                <input type="number" min="1" name="rut" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">telefono</label>
                                <input type="number" min="1" name="telefono" class="form-control shadow-none" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">residencia</label>
                                <input type="number" min="1" name="residencia" class="form-control shadow-none" required>
                            </div>                  
                            <input type="hidden" name="residentes_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">UPDATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>

    <script>
        let add_residentes_form = document.getElementById('add_residentes_form');
        add_residentes_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_residentes();
        });

        let edit_residentes_form = document.getElementById('edit_residentes_form');
        edit_residentes_form.addEventListener('submit', function(e) {
            e.preventDefault();
            edit_details();
        });

        function add_residentes() {
            let data = new FormData(add_residentes_form);
            data.append('add_residentes', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/residentes.php", true);

            xhr.onload = function() {
                if (this.status === 200) {
                    let myModal = new bootstrap.Modal(document.getElementById('add-residentes-modal'));
                    myModal.hide();

                    if (this.responseText.trim() === '1') {
                        alert('success', 'New residentes added');
                        add_residentes_form.reset();
                        get_all_residentes();
                    } else {
                        alert('error', 'Server down');
                    }
                }
            };
            xhr.send(data);
        }

        function get_all_residentes() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/residentes.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('residentes-data').innerHTML = this.responseText;
                } else {
                    console.error('Error fetching residentes:', this.status);
                }
            };

            xhr.send('get_all_residentes=1');
        }

        function toggle_status(id, val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/residentes.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status === 200) {
                    if (this.responseText.trim() === '1') {
                        alert('success', 'Status toggled');
                        get_all_residentes();
                    } else {
                        alert('error', 'Server down');
                    }
                }
            };

            xhr.send('toggle_status=' + id + '&value=' + val);
        }

        function edit_details(id_residentes) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/residentes.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.status === 200) {
            try {
                let residentesData = JSON.parse(this.responseText);
                if (residentesData.residentesdata) {
                    let residentes = residentesData.residentesdata;
                    document.querySelector('#edit_residentes_form input[name="name"]').value = residentes.name;
                    document.querySelector('#edit_residentes_form input[name="area"]').value = residentes.area;
                    document.querySelector('#edit_residentes_form input[name="price"]').value = residentes.price;
                    document.querySelector('#edit_residentes_form input[name="quantity"]').value = residentes.quantity;
                    document.querySelector('#edit_residentes_form input[name="adult"]').value = residentes.adult;
                    document.querySelector('#edit_residentes_form input[name="children"]').value = residentes.children;
                    document.querySelector('#edit_residentes_form textarea[name="desc"]').value = residentes.desc;
                    document.querySelector('#edit_residentes_form input[name="residentes_id"]').value = residentes.id;

                    let myModal = new bootstrap.Modal(document.getElementById('edit-residentes-modal'));
                    myModal.show();
                } else {
                    console.error("No residentes data found.");
                }
            } catch (e) {
                console.error("Error parsing JSON response: ", e);
            }
        } else {
            console.error("Error in request: ", xhr.status);
        }
    };

    xhr.send('get_residentes=' + id);
}

        function remove_residentes(residentes_id) {
    if (confirm("¿Estás seguro de que quieres eliminar este residente?")) {
        let data = new FormData();
        data.append('residentes_id', residentes_id);
        data.append('remove_residentes', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/residentes.php", true);

        xhr.onload = function () {
            if (this.status == 200) {
                if (this.responseText == 1) {
                    alert('Éxito: Residente eliminado/a');
                    get_all_residentes(); // Otra función para actualizar la lista de habitaciones después de la eliminación
                } else {
                    alert('Error: No se pudo eliminar el residente');
                }
            } else {
                alert('Error: Problema con la solicitud AJAX');
            }
        };

        xhr.onerror = function () {
            alert('Error: Problema de red al intentar eliminar');
        };

        xhr.send(data);
    }
}


        window.onload = function() {
            get_all_residentes();
        };
    </script>
</body>
</html>
