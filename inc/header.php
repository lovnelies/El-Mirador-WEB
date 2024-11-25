<!-- header.php -->

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/common.css">

    <title>EL MIRADOR</title>
</head>
<body>
    <!-- Menu --><nav id="menu"><ul class="links"><li><a href="index.html">Home</a></li>
					<li><a href="generic.html">Generic</a></li>
					<li><a href="elements.html">Elements</a></li>
				</ul><ul class="actions vertical"><li><a href="#" class="button fit">Login</a></li>
				</ul></nav>
    <nav class="navbar navbar-expand-lg navbar-light bg2 px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <c class="navbar-brand me-5 fw-bold fs-3 playwrite-gb-s-XD text-white" href="index.php">EL MIRADOR</c>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link active text-white" aria-current="page" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="morosidades.php">Morisidades</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="about.php">Contacto</a>
                    </li>
                    
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-light shadow-none" onclick="window.location.href='solicitudes.php'">
                            Solicitudes
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
