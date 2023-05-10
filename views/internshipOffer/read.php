<?php

if (!isset($_SESSION['role'])) {
    header('Location: /');
    die();
}

?>

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
                <h3><?= $InternshipOffer['offer_title'] ?></h3>
                <h5><?= $InternshipOffer['name_company'] ?> (<?= substr($InternshipOffer['postal_code'], 0, -3) ?> <?= $InternshipOffer['city'] ?>)</h5>
                <p>published : <?= $InternshipOffer['offer_date'] ?></p>
            </div>
            <div class="card-body overflow-auto">
                <p>
                <h4>Offer description : </h4><?= $InternshipOffer['offer_text'] ?></p>
                <p>Skills needed : <?= $InternshipOffer['skills'] ?></p>
                <p>Duration : <?= $InternshipOffer['duration'] ?></p>
                <p>Salary : <?= $InternshipOffer['salary'] ?>€</p>
                <p>Places available : <?= $InternshipOffer['nb_avilable_places'] ?></p>
                <p>Promotion concerned <?= $InternshipOffer['name_promotion'] ?></p>
            </div>
            <div class="card-footer">
                <div class="btn-group" role="group">
                    <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin', 'Student'])) : ?>
                        <a href="/Candidacy/Apply/<?= $InternshipOffer['id_internship_offer'] ?>" class="btn btn-offer"><i class="fa-solid fa-envelope"></i> Apply</a>
                        <a href="/Wishlist/Create/<?= $InternshipOffer['id_internship_offer'] ?>" class="btn btn-offer"><i class="fa-solid fa-heart"></i></a>
                    <?php endif; ?>
                </div>
                <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin', 'Pilot'])) : ?>
                    <div class="button">
                        <a href="/InternshipOffer/Edit/<?= $InternshipOffer['id_internship_offer'] ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <a href="/InternshipOffer/Delete/<?= $InternshipOffer['id_internship_offer'] ?>" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> Delete</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include('views/components/footer.php') ?>