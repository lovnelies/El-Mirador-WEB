<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Mirador</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/common.css">
    
</head>
<body class="bg-dark">
    
    <?php require('inc/header.php'); ?>
    <div class="banner-container">
        <img src="images/carousel/1.jpg" alt="Banner" class="banner-image">
    </div>
    <p class="mt-5 pt-4 mb-4 text-center fw-bold playwrite-gb-s-XD text-white" href="index.php">BIENVENIDO/A</p>
        <p class="mt-5 pt-4 mb-4 text-center fw-bold playwrite-gb-s-XD">Ubicación e Información</p>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg1 rounded">
                    <iframe class="w-100 rounded"height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25321.00904576202!2d-72.66577075!3d-37.50494319999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x966a28deed79832b%3A0x27666816b375fa00!2zTmFjaW1pZW50bywgQsOtbyBCw61v!5e0!3m2!1ses!2scl!4v1719440456679!5m2!1ses!2scl"   allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="bg-dark ph-4 rounded mb-4">
                        <h5>Llámanos</h5>
                        <a href="telefono: +56966666666" class="d-inline-block mb-2 text-decoration-none text-white">
                            <i class="bi bi-telephone-fill"></i> +56966666666
                        </a>
                        <br>
                        <a href="telefono: +56966666666" class="d-inline-block text-decoration-none text-white">
                            <i class="bi bi-telephone-fill"></i> +56966666666
                        </a>
                        <h5 class="mt-4 ">Email</h5>
                        <a href="mail@XD.com" class="d-inline-block text-decoration-none text-white">XDDDD@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>

    <?php require('inc/footer.php'); ?>

<br><br><br>
<br><br><br>


    <script>
        var swiper = new Swiper('.swiper-container', {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
</body>
</html>
