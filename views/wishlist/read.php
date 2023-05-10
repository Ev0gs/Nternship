<?php

if (!isset($_SESSION['role'])) {
    header('Location: /');
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('views/components/header.php') ?>
<!-- Banner -->
<div class="banner text-center">
    <h1>INTERNSHIP FOR YOU</h1>
    <p>On our website you'll find your internship</p>
</div>

<h1 class="mt-5 text-center">Wishlist</h1>
<!-- Wishlist container-->
<div class="content-container" id="internship-container">
    <!-- Details Wishlist offer container -->
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
                <p>Protion concerned <?= $InternshipOffer['name_promotion'] ?></p>
            </div>
            <div class="card-footer">
                <div class="btn-group" role="group">
                    <a href="/Candidacy/Apply/<?= $InternshipOffer['id_internship_offer'] ?>" class="btn btn-offer"><i class="fa-solid fa-envelope"></i> Apply</a>
                </div>
                <div class="button">
                    <a href="/InternshipOffer/Delete/<?= $InternshipOffer['id_internship_offer'] ?>" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> Remove</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('views/components/footer.php') ?>