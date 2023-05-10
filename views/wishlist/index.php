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

<!-- Wishlist container-->
<div class="content-container" id="internship-container">
    <!-- Wishlist brief container -->
    <div class="content-brief-container" id="internship-brief-container">
        <!-- Cards generation from BDD -->
        <?php foreach ($InternshipOffer as $InternshipOffer) : ?>
            <a href="/Wishlist/Read/<?= $InternshipOffer['id_internship_offer'] ?>">
                <div class="card" id="card">
                    <div class="card-header">
                        <h3><?= $InternshipOffer['offer_title'] ?></h4>
                            <h5><?= $InternshipOffer['name_company'] ?> (<?= substr($InternshipOffer['postal_code'], 0, -3) ?> <?= $InternshipOffer['city'] ?>)</h5>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Promotion concerned : <?= $InternshipOffer['name_promotion'] ?></li>
                            <li>Skills : <?= $InternshipOffer['skills'] ?></li>
                            <li><?= $InternshipOffer['salary'] ?>€ per months</li>
                            <li>Duration : <?= $InternshipOffer['duration'] ?></li>
                        </ul>
                        <p>Published : <?= $InternshipOffer['offer_date'] ?></p>
                    </div>
                    <div class="card-footer">
                        <div class="button">
                            <a href="Wishlist/Delete/<?= $InternshipOffer['id_internship_offer'] ?>" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> Delete</a>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php include('views/components/footer.php') ?>