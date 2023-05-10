<?php

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin', 'Pilot'])) {
    header('Location: /');
    die();
}

?>

<?php include('views/components/header.php') ?>
<!-- Create new internship offer form -->
<div class="form-container">
    <h1 class="text-center mb-5">Edit an internship offer</h1>
    <form method="POST" action="/InternshipOffer/Edit/<?= $InternshipOffer['id_internship_offer'] ?>" id="offerEditForm">
        <!-- Offer Title -->
        <div class="mb-3">
            <label for="InputOfferTitle" class="form-label">Offer title</label>
            <input type="text" class="form-control" name="InputOfferTitle" id="InputOfferTitle" value="<?= $InternshipOffer['offer_title'] ?>" />
        </div>
        <!-- Offer Text -->
        <div class="mb-3">
            <label for="InputOfferText" class="form-label">Offer description</label>
            <textarea class="form-control" name="InputOfferText" form="offerEditForm" id="InputOfferText" cols="30" rows="10"><?= $InternshipOffer['offer_text'] ?></textarea>
        </div>
        <!-- Skills -->
        <div class="mb-3">
            <label for="InputSkills" class="form-label">Skills</label>
            <input type="text" class="form-control" name="InputSkills" id="InputSkills" value="<?= $InternshipOffer['skills'] ?>" />
        </div>
        <!-- Duration -->
        <div class="mb-3">
            <label for="InputDuration" class="form-label">Duration</label>
            <input type="text" class="form-control" name="InputDuration" id="InputDuration" value="<?= $InternshipOffer['duration'] ?>" />
        </div>
        <!-- Salary -->
        <div class="mb-3">
            <label for="InputSalary" class="form-label">Salary €</label>
            <input type="text" class="form-control" name="InputSalary" id="InputSalary" value="<?= $InternshipOffer['salary'] ?>" />
        </div>
        <!-- Offer Date -->
        <div class="mb-3">
            <label for="InputOfferDate" class="form-label">OfferDate</label>
            <input type="date" class="form-control" name="InputOfferDate" id="InputOfferDate" value="<?= $InternshipOffer['offer_date'] ?>" />
        </div>
        <!-- Nb Available Places -->
        <div class="mb-3">
            <label for="InputNbPlaces" class="form-label">Number of places</label>
            <input type="text" class="form-control" name="InputNbPlaces" id="InputNbPlaces" value="<?= $InternshipOffer['nb_avilable_places'] ?>" />
        </div>
        <!-- Id Company (or Company name) -->
        <div class="mb-3">
            <label for="InputIdCompany" class="form-label">Company</label>
            <select class="form-control" name="InputIdCompany" id="InputIdCompany">
                <Option selected><?= $CompaniesNameById['name_company'] ?></Option>
                <!-- Send request for company names -->
                <?php foreach ($CompaniesName as $CompaniesName) : ?>
                    <Option><?= $CompaniesName['name_company'] ?></Option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Id Promotions (or promotion name) -->
        <div class="mb-3">
            <label for="InputIdPromotion" class="form-label">Promotion</label>
            <select class="form-control" name="InputIdPromotion" id="InputIdPromotion">
                <Option selected><?= $PromotionNameById['name_promotion'] ?></Option>
                <!-- Send request for company names -->
                <?php foreach ($PromotionName as $PromotionName) : ?>
                    <Option><?= $PromotionName['name_promotion'] ?></Option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include('views/components/footer.php') ?>