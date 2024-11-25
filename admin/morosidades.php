<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Gestión Personal</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light ">
    <?php require('inc/header.php'); ?>

    <p class="mt-5 pt-4 mb-4 text-center fw-bold playwrite-gb-s-XD">nombre y deuda</p>
    <div class="container-fluid mt-5 pt-4 mb-4 text-center">
    <table class="table mt-5 pt-4 mb-4table-dark table-striped">
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

 <!--   
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Gestión Personal</h3>
                <div class="card-body">
                    <div class="text-end mb-4">
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-event-modal">
                            <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>

                    <div class="table-responsive-lg">
                        <table class="table table-hover border">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre  </th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody id="event-data">
                                Aquí se mostrarán los eventos -->
                                <?php
                                // PHP para mostrar los eventos (puedes dejarlo vacío inicialmente)
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD EVENT MODAL 
    <div class="modal fade" id="add-event-modal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="add_event_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" rows="4" class="form-control shadow-none" required></textarea>
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
-->
    <!-- EDIT EVENT MODAL 
    <div class="modal fade" id="edit-event-modal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="edit_event_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" rows="4" class="form-control shadow-none" required></textarea>
                            </div>
                            <input type="hidden" name="event_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">UPDATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>-->

    <?php require('inc/scripts.php'); ?>

    <script>
        let add_event_form = document.getElementById('add_event_form');
        add_event_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_event();
        });

        let edit_event_form = document.getElementById('edit_event_form');
        edit_event_form.addEventListener('submit', function(e) {
            e.preventDefault();
            edit_event();
        });

        function add_event() {
            let data = new FormData(add_event_form);
            data.append('add_event', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/events.php", true);

            xhr.onload = function() {
                if (this.status === 200) {
                    let myModal = new bootstrap.Modal(document.getElementById('add-event-modal'));
                    myModal.hide();

                    if (this.responseText.trim() === '1') {
                        alert('Event added successfully');
                        add_event_form.reset();
                        fetchEvents();
                    } else {
                        alert('Error adding event');
                    }
                }
            };

            xhr.send(data);
        }

        function fetchEvents() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/events.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('event-data').innerHTML = this.responseText;
                } else {
                    console.error('Error fetching events:', this.status);
                }
            };
            xhr.send('get_all_events=1');
        }

        function edit_event() {
            let data = new FormData(edit_event_form);
            data.append('edit_event', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/events.php", true);

            xhr.onload = function() {
                if (this.status === 200) {
                    let myModal = new bootstrap.Modal(document.getElementById('edit-event-modal'));
                    myModal.hide();

                    if (this.responseText.trim() === '1') {
                        alert('Event updated successfully');
                        fetchEvents();
                    } else {
                        alert('Error updating event');
                    }
                }
            };

            xhr.send(data);
        }

        function edit_details(id) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/events.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status === 200) {
                    try {
                        let eventData = JSON.parse(this.responseText);
                        if (eventData.eventdata) {
                            let event = eventData.eventdata;
                            document.querySelector('#edit_event_form input[name="name"]').value = event.name;
                            document.querySelector('#edit_event_form textarea[name="description"]').value = event.description;
                            document.querySelector('#edit_event_form input[name="event_id"]').value = event.id;

                            let myModal = new bootstrap.Modal(document.getElementById('edit-event-modal'));
                            myModal.show();
                        } else {
                            console.error("No event data found.");
                        }
                    } catch (e) {
                        console.error("Error parsing JSON response: ", e);
                    }
                } else {
                    console.error("Error in request: ", xhr.status);
                }
            };

            xhr.send('get_event=' + id);
        }

        function remove_event(event_id) {
            if (confirm("Are you sure you want to delete this event?")) {
                let data = new FormData();
                data.append('event_id', event_id);
                data.append('remove_event', '');

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/events.php", true);

                xhr.onload = function() {
                    if (this.status === 200) {
                        if (this.responseText === '1') {
                            alert('Event deleted successfully');
                            fetchEvents();
                        } else {
                            alert('Error deleting event');
                        }
                    }
                };

                xhr.send(data);
            }
        }

        window.onload = function() {
            fetchEvents();
        };
    </script>
</body>
</html>
