<div class="col-12">
    <h3 class="text-primary fw-bold fs-1 mt-3"><?php echo $templateParams["pageName"]; ?></h3>
</div>

<div class="col-12 mt-5 mb-5 pt-5">
    <p class="<?php echo $templateParams['error'] ? 'text-danger' : 'text-success'?> fw-bold fs-4"><?php echo $templateParams["message"];?></p>
</div>

<div class="col-12 mt-5 pt-5">
    <div class="col-md-6 d-grid pe-1">
        <a href="index.php" class="btn btn-primary btn-lg rounded-0">Home</a>
    </div>
</div>