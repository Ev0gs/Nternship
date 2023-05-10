<?php

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin', 'Pilot'])) {
    header('Location: /');
    die();
}

?>
<title>Nternship | Users</title>
<?php include('views/components/header.php') ?>
<!-- Banner -->
<div class="banner text-center">
    <h1>INTERNSHIP FOR YOU</h1>
    <p>On our website you'll find your internship</p>
</div>

<!-- Internship container-->
<div class="content-container" id="internship-container">
    <!-- Details internship container -->
    <div class="content-details-container" id="internship-details-container">
        <div class="card">
            <div class="card-header">
                <h3><?= $user['first_name'] ?> <?= $user['name'] ?></h4>
                    <h5><?= $user['Email'] ?></h5>
            </div>
            <div class="card-body">
                <ul>
                    <li>Birthdate <?= $user['birthdate'] ?></li>
                    <li>Gender : <?= $user['gender'] ?></li>
                    <li>Phone Number : <?= $user['phone_number'] ?></li>
                    <li>Statut : <?= $user['role'] ?></li>
                    <li>Campus : <?= $user['campus'] ?></li>
                    <li>City : <?= $user['city'] ?></li>
                    <li>Postal Code : <?= $user['postal_code'] ?></li>
                    <li>Postal Address : <?= $user['postal_address'] ?></li>
                    <li>Additional : <?= $user['additional'] ?></li>
                    <li>Promotion : <?= $promotion['name_promotion'] ?></li>

                </ul>
            </div>
            <div class="card-footer">
                <div class="button">
                    <a href="/users/Edit/<?= $user['id_user'] ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                    <a href="/users/Delete/<?= $user['id_user'] ?>" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('views/components/footer.php') ?>