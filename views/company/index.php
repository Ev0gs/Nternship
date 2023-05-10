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
<!-- Search internship -->
<div class="search-box text-center">
    <form method="POST" action="/Company/Search">
        <div>
            <i class="fa-solid fa-magnifying-glass"></i><input type="text" class="form-control" name="InputWhat" placeholder="What" id="WhatSearch" />
        </div>
        <div>
            <i class="fa-solid fa-location-dot"></i><input type="text" class="form-control" name="InputWhere" placeholder="Where" id="WhereSearch" />
        </div>
        <input type="submit" class="btn btn-primary" value="Search Company">
    </form>
</div>

<!-- Company container-->
<div class="content-container" id="internship-container">
    <!-- Buttons -->
    <div class="button-container">
        <!-- Filter buttons -->
        <!-- <div class="btn-group" role="group">
                <a href="/Company" class="btn btn-filter active" id="BestMatchesBtn">Best Matches</a>
                <a href="/Company/MostRecent" class="btn btn-filter" id="MostRecentBtn">Most Recent</a>
            </div> -->
        <!-- Create a new offer button -->
        <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin', 'Pilot'])) : ?>
            <div class="add-button-container">
                <a class="btn" href="/Company/Create" id="add-button"><i class="fa-solid fa-square-plus"></i> Add</a>
            </div>
        <?php endif; ?>
    </div>
    <!-- Company brief container -->
    <div class="content-brief-container" id="internship-brief-container">
        <!-- Cards generation from BDD -->
        <?php foreach ($companies as $Company) : ?>
            <a href="/Company/Read/<?= $Company['id_company'] ?>">
                <div class="card" id="card">
                    <div class="card-header">
                        <h3><?= $Company['name_company'] ?></h4>
                            <h5><?= $Company['city'] ?> (<?= substr($Company['postal_code'], 0, -3) ?>)</h5>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Activity sector : <?= $Company['activity_sector'] ?></li>
                            <li>Address : <?= $Company['postal_address'] ?>, <?= $Company['postal_code'] ?> <?= $Company['city'] ?></li>
                            <li>Number of Cesi student already taken : <?= $Company['nb_cesi_trainee'] ?></li>
                            <li>Grade : <?= $Company['averageRate'] ?></li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin', 'Pilot'])) : ?>
                            <div class="button">
                                <a href="/company/Edit/<?= $Company['id_company'] ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                <a href="/company/Delete/<?= $Company['id_company'] ?>" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> Delete</a>
                            </div>
                        <?php else : ?>
                            <div class="button">
                                <a href="/company/rate/<?= $Company['id_company'] ?>" class="btn"><i class="fa-solid fa-eye"></i> Rate</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php include('views/components/footer.php') ?>