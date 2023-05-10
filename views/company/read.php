<?php

if (!isset($_SESSION['role'])) {
    header('Location: /');
    die();
}

?>

<title>Nternship | Companies</title>
<?php include('views/components/header.php') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Banner -->
<div class="banner text-center">
    <h1>Companies</h1>
    <p>On our website you'll find your internship</p>
</div>

<!-- Company container-->
<div class="content-container" id="internship-container">
    <!-- Details company container -->
    <div class="content-details-container" id="internship-details-container">
        <div class="card">
            <div class="card-header">
                <h3><?= $Company['name_company'] ?></h3>
                <h5><?= $Company['city'] ?> (<?= substr($Company['postal_code'], 0, -3) ?>)</h5>
            </div>
            <div class="card-body overflow-auto">
                <p>Activity sector : <?= $Company['activity_sector'] ?></p>
                <p>Address : <?= $Company['postal_address'] ?>, <?= $Company['postal_code'] ?> <?= $Company['city'] ?></p>
                <p>Number of Cesi student already taken : <?= $Company['nb_cesi_trainee'] ?></p>
            </div>
            <div class="card-footer">
                <!-- <div class="btn-group" role="group">
                        <a href="" class="btn">Rate</a>
                    </div> -->
                <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin', 'Pilot'])) : ?>
                    <div class="button">
                        <a href="/Company/Edit/<?= $Company['id_company'] ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <a href="/Company/Delete/<?= $Company['id_company'] ?>" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> Delete</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include('views/components/footer.php') ?>