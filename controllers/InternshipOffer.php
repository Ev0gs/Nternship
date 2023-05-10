<?php
// Create a new class for the controller (that will be linked to the "InternshipOffer" table in our case)
class InternshipOffer extends Controller
{
    // Define a public function
    public function index()
    {
        // Loading the model who match with the table used
        $this->loadModel("ModelInternshipOffer");

        // Store the return value from the query that has been executed
        $InternshipOffer = $this->ModelInternshipOffer->getInfoInternshipOffer();

        // Sending data to the view
        $this->render('index', ['InternshipOffer' => $InternshipOffer]);
    }

    public function Search()
    {
        $form = new Form;
        if (Form::validate($_POST, ['InputWhat', 'InputWhere'])) {
            $this->loadModel("ModelInternshipOffer");
            $InternshipOffer = $this->ModelInternshipOffer->search();
            $this->render('index', ['InternshipOffer' => $InternshipOffer]);
        } else {
            echo '<script>alert("You may fill all the search inputs before submiting!")</script>';
        }
    }

    public function MostRecent()
    {
        $this->loadModel("ModelInternshipOffer");
        $InternshipOffers = $this->ModelInternshipOffer->mostRecent();
        $this->render('mostRecent', ['InternshipOffers' => $InternshipOffers]);
    }

    public function Read($id)
    {
        $this->loadModel("ModelInternshipOffer");
        $InternshipOffer = $this->ModelInternshipOffer->findById($id);
        $this->render('read', ['InternshipOffer' => $InternshipOffer]);
    }

    public function Create()
    {
        $this->loadModel("ModelCompany");
        $this->loadModel("ModelPromotion");
        $form = new Form;
        if (Form::validate($_POST, ['InputOfferTitle', 'InputOfferText', 'InputSkills', 'InputDuration', 'InputSalary', 'InputOfferDate', 'InputNbPlaces', 'InputIdCompany', 'InputIdPromotion'])) {
            $this->loadModel("ModelInternshipOffer");
            $this->ModelInternshipOffer->Create();
        }
        $CompaniesName = $this->ModelCompany->getAll();
        $PromotionName = $this->ModelPromotion->getAll();
        $this->render2data('create', ['CompaniesName' => $CompaniesName], ['PromotionName' => $PromotionName]);
    }

    public function Delete($id)
    {
        // $this->loadModel("ModelWishlist");
        // $this->ModelWishlist->remove($id);
        $this->loadModel("ModelInternshipOffer");
        $this->ModelInternshipOffer->Delete($id);
    }

    public function Edit($id)
    {

        $this->loadModel("ModelInternshipOffer");
        $this->loadModel("ModelCompany");
        $this->loadModel("ModelPromotion");
        $form = new Form;
        if (Form::validate($_POST, ['InputOfferTitle', 'InputOfferText', 'InputSkills', 'InputDuration', 'InputSalary', 'InputOfferDate', 'InputNbPlaces', 'InputIdCompany', 'InputIdPromotion'])) {
            $this->ModelInternshipOffer->Update($id);
            header('Location: /internshipoffer');
            die();
        }
        $InternshipOffer = $this->ModelInternshipOffer->findById($id);
        $CompaniesNameById = $this->ModelCompany->getByInternshipId($id);
        $CompaniesName = $this->ModelCompany->getAll();
        $PromotionNameById = $this->ModelPromotion->getByInternshipId($id);
        $PromotionName = $this->ModelPromotion->getAll();
        $this->render5data('edit', ['InternshipOffer' => $InternshipOffer], ['CompaniesNameById' => $CompaniesNameById], ['CompaniesName' => $CompaniesName], ['PromotionNameById' => $PromotionNameById], ['PromotionName' => $PromotionName]);
    }
}
