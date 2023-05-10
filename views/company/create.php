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
    <h1 class="text-center mb-5">Create a company</h1>
    <form method="POST" action="/Company/Create" id="offerEditForm">
        <!-- Company name -->
        <div class="mb-3">
            <label for="InputCompanyName" class="form-label">Company name</label>
            <input type="text" class="form-control" name="InputCompanyName" id="InputCompanyName" />
        </div>
        <!-- Company activity sector -->
        <div class="mb-3">
            <label for="InputActivitySector" class="form-label">Company activity sector</label>
            <input type="text" class="form-control" name="InputActivitySector" id="InputActivitySector" />
        </div>
        <!-- Company number cesi students -->
        <div class="mb-3">
            <label for="InputNbCesiStudents" class="form-label">Number Cesi students already taken</label>
            <input type="text" class="form-control" name="InputNbCesiStudents" id="InputNbCesiStudents" />
        </div>
        <!-- Address -->
        <div class="mb-3">
            <label for="InputAddress" class="form-label">Address</label>
            <input type="text" class="form-control" name="InputAddress" id="InputAddress" />
        </div>
        <!-- City -->
        <div class="mb-3">
            <label for="InputCity" class="form-label">City</label>
            <input type="text" class="form-control" name="InputCity" id="InputCity" />
        </div>
        <!-- Postal Code -->
        <div class="mb-3">
            <label for="InputPostalCode" class="form-label">Postal code</label>
            <input type="text" class="form-control" name="InputPostalCode" id="InputPostalCode" />
        </div>
        <!-- Address additional infos -->
        <div class="mb-3">
            <label for="InputAdditional" class="form-label">Address additional informations</label>
            <input type="text" class="form-control" name="InputAdditional" id="InputAdditional" />
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include('views/components/footer.php') ?>