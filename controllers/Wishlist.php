<?php
    // Create a new class for the controller (that will be linked to the "InternshipOffer" table in our case)
    class Wishlist extends Controller
    {
        // Define a public function
        public function index()
        {
            // Loading the model who match with the table used
            $this->loadModel("ModelWishlist");

            // Store the return value from the query that has been executed
            $InternshipOffer = $this->ModelWishlist->getAllWishlist();

            // Sending data to the view
            $this->render('index', ['InternshipOffer'=>$InternshipOffer]);
        }

        public function Read($idInternshipOffer)
        {
            $this->loadModel("ModelInternshipOffer");
            $InternshipOffer = $this->ModelInternshipOffer->findById($idInternshipOffer);
            $this->render('read', ['InternshipOffer'=>$InternshipOffer]);
        }

        public function Create($idInternshipOffer)
        {
            $this->loadModel("ModelWishlist");
            $this->ModelWishlist->add($idInternshipOffer);
        }

        public function Delete($idInternshipOffer)
        {
            $this->loadModel("ModelWishlist");
            $this->ModelWishlist->remove($idInternshipOffer);
        }
    }
?>