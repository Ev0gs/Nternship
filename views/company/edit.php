<?php

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin', 'Pilot'])) {
    header('Location: /');
    die();
}

?>
<title>Nternship | Companies</title>
<?php include('views/components/header.php') ?>
<!-- Create new internship offer form -->
<div class="form-container">
    <h1 class="text-center mb-5">Edit a company</h1>
    <form method="POST" action="/Company/Edit/<?= $Company['id_company'] ?>" id="offerEditForm">
        <!-- Company name -->
        <div class="mb-3">
            <label for="InputCompanyName" class="form-label">Company name</label>
            <input type="text" class="form-control" name="InputCompanyName" id="InputCompanyName" value="<?= $Company['name_company'] ?>" />
        </div>
        <!-- Company activity sector -->
        <div class="mb-3">
            <label for="InputActivitySector" class="form-label">Company activity sector</label>
            <input type="text" class="form-control" name="InputActivitySector" id="InputActivitySector" value="<?= $Company['activity_sector'] ?>" />
        </div>
        <!-- Company number cesi students -->
        <div class="mb-3">
            <label for="InputNbCesiStudents" class="form-label">Number Cesi students already taken</label>
            <input type="text" class="form-control" name="InputNbCesiStudents" id="InputNbCesiStudents" value="<?= $Company['nb_cesi_trainee'] ?>" />
        </div>
        <!-- Address -->
        <div class="mb-3">
            <label for="InputAddress" class="form-label">Address</label>
            <input type="text" class="form-control" name="InputAddress" id="InputAddress" value="<?= $Company['postal_address'] ?>" />
        </div>
        <!-- City -->
        <div class="mb-3">
            <label for="InputCity" class="form-label">City</label>
            <input type="text" class="form-control" name="InputCity" id="InputCity" value="<?= $Company['city'] ?>" />
        </div>
        <!-- Postal Code -->
        <div class="mb-3">
            <label for="InputPostalCode" class="form-label">Postal code</label>
            <input type="text" class="form-control" name="InputPostalCode" id="InputPostalCode" value="<?= $Company['postal_code'] ?>" />
        </div>
        <!-- Address additional infos -->
        <div class="mb-3">
            <label for="InputAdditional" class="form-label">Address additional informations</label>
            <input type="text" class="form-control" name="InputAdditional" id="InputAdditional" value="<?= $Company['additional'] ?>" />
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include('views/components/footer.php') ?>