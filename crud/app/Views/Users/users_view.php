<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <?php require_once('../app/Views/assets/css/css.php'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    
    <!-- Title -->
    <title><?= $title ?></title>
</head>
<body>
<!-- Preload -->
<?php require_once('../app/Views/preload/preload.php') ?>
<!-- End Preload -->

<!-- NavBar -->
<?php require_once('../app/Views/nav/navbar.php') ?>
<!-- End NavBar -->

<!-- Container -->
<div class="container">
    <h3><?= $title ?></h3>
    <button type="button" class="btn btn-primary" id="btnSubmit" onClick="add()" style="font-size: 0.5em;">ADD</button>

    <!-- Container Table -->
    <?php require_once('../app/Views/Users/table.php') ?>
    <!-- End Container Table -->
</div>
<!-- End Container -->

<!-- Footer -->
<?php require_once('../app/Views/footer/footer.php') ?>
<!-- End Footer -->

<!-- Modal -->
<div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <?php require_once('../app/Views/Users/form.php'); ?>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="my-form" class="btn btn-primary">Send Data</button>
            </div>
        </div>
    </div>
</div>

<!-- JS Files -->
<?php require_once('../app/Views/assets/js/js.php'); ?>
<?php require_once('../app/Views/assets/js/dataTable.php'); ?>

<!-- JS Controller -->
<script src="../controllers/Users/users.js"></script>
</body>
</html>
