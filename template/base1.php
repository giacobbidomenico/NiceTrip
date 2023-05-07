<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title><?php echo $templateParams["title"];?></title>
</head>
<body>
    <div class="container-fluid p-0 overflow-hidden">
        <div class="row pt-3 ps-5 mb-2">
            <header>
                <img class="img-fluid float-start d-inlin-block" src="<?php echo UPLOAD_DIR.$templateParams["iconName"]; ?>" alt="<?php echo $templateParams["iconDescription"];?>" />
                <h1 class="fw-bold fs-1 d-inline-block text-primary"><?php echo $templateParams["title"];?></h1>
                <h2 class="fw-italic fs-6 text-muted"><?php echo $templateParams["subtitle"];?></h2>
            </header>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-12 col-md-6 d-none d-md-block">
                <img class="img-fluid rounded" src="<?php echo UPLOAD_DIR.$templateParams["mainImageName"]; ?>" alt="<?php echo $templateParams["mainImageDescription"];?>" />
            </div>
            <div class="col-12 col-md-5">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
