<?php include('views/components/header.php') ?>
<link rel="stylesheet" href="/views/assets/style_apply.css">


<div class="container mt-5">
    <form method="POST" action="/candidacy/applyPost/<?= $InternshipOffer['id_internship_offer'] ?>" id="ApplyForm" enctype="multipart/form-data">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card p-3 py-4">
                    <div class="text-center mt-3"> <span class="bg-secondary p-1 px-4 rounded text-white">Internship</span>
                        <h5 class="mt-2 mb-0"><?= $InternshipOffer['offer_title'] ?></h5> <span><?= $InternshipOffer['name_company'] ?></span>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Step 1 : Import your CV</label>
                            <input class="form-control" type="file" accept=".PDF" id="formCV" name="formCV" />
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Step 2 : Import your Motivation Letter</label>
                            <input class="form-control" type="file" accept=".PDF" id="formLM" name="formLM" />
                        </div> <br />
                        <div class="buttons"><button class="btn btn-outline-primary px-4">Submit</button> </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> <br />



<?php include('views/components/footer.php') ?>