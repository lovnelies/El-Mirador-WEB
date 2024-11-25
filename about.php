<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VERANUM - ABOUT</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        .about-image {
            width: 500px;
            height: 500px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-dark">
    
    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio ex, libero, 
            corporis earum possimus at nihil est incidunt iusto nostrum ab veniam similique? 
            Quam sint alias tenetur quia porro.
        </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-5 mb-4">
                <h3 class="mb-3">lorem ipsum xd</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, 
                    similique. Animi corporis, esse non consequuntur pariatur dolor dicta 
                    soluta ipsa.
                </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4">
                <img src="images/about/about.jpg" class="about-image">
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>

</body>
</html>
