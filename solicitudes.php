<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VERANUM - Solicitudes</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-dark">
    
    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Ingresa tu solicitud</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, doloremque.
        </p>
    </div>

    <div class="modal-dialog modal-lg">
        <form id="add_solicitudes_form" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">ID Residencia</label>
                            <input type="number" name="id_residente" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tipo de Solicitud</label>
                            <select name="tipo" class="form-control shadow-none" required>
                                <option value="queja">Queja</option>
                                <option value="mantenimiento">Mantenimiento</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Descripción</label>
                            <textarea name="descripcion" rows="4" class="form-control shadow-none" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">Ingresar</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Área de notificación (inicialmente oculta) -->
    <div id="notification" class="alert alert-success" style="display: none; position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
        Solicitud añadida correctamente
    </div>

    <script>
    $(document).ready(function () {
        $('#add_solicitudes_form').on('submit', function (e) {
            e.preventDefault(); // Evita la recarga de la página

            let formData = new FormData(this);

            $.ajax({
                url: 'add_request.php', // Archivo PHP para procesar la solicitud
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json', // Espera una respuesta JSON
                success: function (response) {
                    if (response.status === 'success') {
                        showNotification(response.message); // Mostrar notificación de éxito
                        $('#add_solicitudes_form')[0].reset(); // Limpiar el formulario
                    } else {
                        showNotification(response.message, 'danger'); // Mostrar mensaje de error
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        });

        // Función para mostrar la notificación
        function showNotification(message, type = 'success') {
            $('#notification').removeClass('alert-success alert-danger'); // Limpiar clases anteriores
            $('#notification').addClass('alert-' + type); // Agregar clase según tipo
            $('#notification').text(message); // Establecer el mensaje
            $('#notification').show(); // Mostrar la notificación

            // Ocultar la notificación después de 3 segundos
            setTimeout(function() {
                $('#notification').hide();
            }, 3000);
        }
    });
    </script>

</body>
</html>
