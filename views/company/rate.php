<?php

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Student', 'Delegate'])) {
    header('Location: /');
    die();
}
?>

<title>Nternship | Companies</title>
<?php include('views/components/header.php') ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Banner -->
<div class="banner text-center">
    <h1>INTERNSHIP FOR YOU</h1>
    <p>On our website you'll find your internship</p>
</div>

<form method="POST" action="/Company/Rate/<?= $Company["id_company"] ?> " id="RateForm">
    <!-- Rate Form -->
    <div class="content-brief-container" id="internship-brief-container">
        <div class="card-header">
            <h3><?= $Company['name_company'] ?></h3>
            <h5><?= $Company['city'] ?> (<?= substr($Company['postal_code'], 0, -3) ?>)</h5>
            <div class="mb-3">
                <label for="InputRate" class="form-label"><?= $Company["name_company"] ?></label>
                <input type="number" class="form-control" name="InputRate" id="InputRate" min="0" max="5" />
            </div>
            <!-- if user already rate the company, delete the submit button -->
            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Evaluate</button></div>
        </div>
    </div>
</form>

<?php include('views/components/footer.php') ?>