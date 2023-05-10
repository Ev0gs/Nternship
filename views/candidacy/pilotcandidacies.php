<?php

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin', 'Pilot'])) {
    header('Location: /');
    die();
}
?>

<?php include('views/components/header.php') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Banner -->
<div class="banner text-center">
    <h1>INTERNSHIP FOR YOU</h1>
    <p>On our website you'll find your internship</p>
</div>

<!-- Candidcy container-->
<div class="content-container" id="candidacy-container">
    <!-- Internship brief container -->
    <div class="content-brief-container" id="internship-brief-candidacy">
        <!-- Cards generation from BDD -->
        <?php foreach ($candidacies as $candidacy) : ?>
            <div class="card">
                <div class="card-header">
                    <h3><?= $candidacy['offer_title'] ?></h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Name : <?= $candidacy['first_name'] . ' ' . $candidacy['name'] ?></li>
                        <li>Company: <?= $candidacy['name_company'] ?>
                        <li>Skills : <?= $candidacy['skills'] ?></li>
                        <li><?= $candidacy['salary'] ?>€ per months</li>
                        <li>Duration : <?= $candidacy['duration'] ?></li>
                        <li>CV posté: <?= $candidacy['curriculum_vitae'] == "1" ? "Oui" : "Non"  ?></li>
                        <li>LM postée: <?= $candidacy['motivation_letter'] == "1" ? "Oui" : "Non"  ?></li>
                    </ul>
                    <p>Published : <?= $candidacy['offer_date'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('views/components/footer.php') ?>