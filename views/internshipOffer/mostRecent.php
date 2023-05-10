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
<!-- Search internship -->
<div class="search-box text-center">
    <form method="POST" action="/InternshipOffer/Search">
        <div>
            <i class="fa-solid fa-magnifying-glass"></i><input type="text" class="form-control" name="InputWhat" placeholder="What" id="WhatSearch" />
        </div>
        <div>
            <i class="fa-solid fa-location-dot"></i><input type="text" class="form-control" name="InputWhere" placeholder="Where" id="WhereSearch" />
        </div>
        <input type="submit" class="btn btn-primary" value="Search internship">
    </form>
</div>

<!-- Internship container-->
<div class="content-container" id="internship-container">
    <!-- Buttons -->
    <div class="button-container">
        <!-- Filter buttons -->
        <div class="btn-group" role="group">
            <a href="/InternshipOffer" class="btn btn-filter" id="BestMatchesBtn">All Offers</a>
            <a href="/InternshipOffer/MostRecent" class="btn btn-filter active" id="MostRecentBtn">Most Recent</a>
        </div>
        <!-- Create a new offer button -->
        <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin', 'Pilot'])) : ?>
            <div class="add-button-container">
                <a class="btn" href="/InternshipOffer/Create" id="add-button"><i class="fa-solid fa-square-plus"></i> Add</a>
            </div>
        <?php endif; ?>
    </div>
    <!-- Internship brief container -->
    <div class="content-brief-container" id="internship-brief-container">
        <!-- Cards generation from BDD -->
        <?php foreach ($InternshipOffers as $InternshipOffer) : ?>
            <a href="/InternshipOffer/Read/<?= $InternshipOffer['id_internship_offer'] ?>">
                <div class="card" id="card">
                    <div class="card-header">
                        <h4><?= $InternshipOffer['offer_title'] ?></h4>
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
                        <div class="btn-group" role="group">
                            <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin', 'Student'])) : ?>
                                <a href="/Candidacy/Apply/<?= $InternshipOffer['id_internship_offer'] ?>" class="btn btn-offer"><i class="fa-solid fa-envelope"></i> Apply</a>
                                <a href="/Wishlist/Create/<?= $InternshipOffer['id_internship_offer'] ?>" class="btn btn-offer"><i class="fa-solid fa-heart"></i></a>
                            <?php endif; ?>
                        </div>
                        <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin', 'Pilot'])) : ?>
                            <div class="button">
                                <a href="InternshipOffer/Edit/<?= $InternshipOffer['id_internship_offer'] ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                <a href="InternshipOffer/Delete/<?= $InternshipOffer['id_internship_offer'] ?>" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> Delete</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php include('views/components/footer.php') ?>