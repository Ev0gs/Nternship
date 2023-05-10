<?php
    // Create a new class for the controller (that will be linked to the "address" table in our case)
    class Address extends Controller
    {
        // Define a public function
        public function index()
        {
            // Loading the model who match with the table used
            $this->loadModel("Modeladdress");

            // Store the return value from the query that has been executed
            $address = $this->Modeladdress->getAll();

            // Sending data to the view
            $this->render('index', ['address'=>$address]);
        }

        public function Read($id)
        {
            $this->loadModel("Modeladdress");
            $address = $this->Modeladdress->getAll();
            $addressDetails = $this->Modeladdress->findById($id);
            $this->render2data('read', ['addressDetails'=>$addressDetails], ['address'=>$address]);
        }

        public function Create()
        {
            $form = new Form;
            if(Form::validate($_POST, ['Inputname','Inputfistname','Inputphonenumber','Inputemail','Inputbirthdate','InputGender','InputCampus','Inputrole','InputPassword']))
            {
                $this->loadModel("Modeladdress");
                $this->Modeladdress->Create();
            }
            $this->loadModel("ModelCompany");
            $CompaniesName = $this->ModelCompany->getAll();
            $this->loadModel("ModelPromotion");
            $PromotionName = $this->ModelPromotion->getAll();
            $this->render2data('create',['CompaniesName'=>$CompaniesName],['PromotionName'=>$PromotionName]);
            
        }

        public function Delete($id)
        {
            $this->loadModel("Modeladdress");
            $address = $this->Modeladdress->Delete($id);
        }
    }
?>