<?php
// Create a new class for the controller (that will be linked to the "candicady" table in our case)
class Candidacy extends Controller
{
    // Define a public function
    public function Apply($idInternshipOffer = null)
    {
        if (!$idInternshipOffer) {
            header('Location: /internshipoffer/index');
            die();
        }

        // Loading the model who match with the table used
        $this->loadModel("ModelInternshipOffer");

        // Store the return value from the query that has been executed
        $InternshipOffer = $this->ModelInternshipOffer->findById($idInternshipOffer);
        if (!$InternshipOffer) {
            header('Location: /internshipoffer/index');
            die();
        }

        // Sending data to the view
        $this->render('apply', ['InternshipOffer' => $InternshipOffer]);
    }

    public function ApplyPost($idInternshipOffer = null)
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST' || !$idInternshipOffer) {
            header('Location: /internshipoffer/index');
            die();
        }

        if (!isset($_SESSION['idUser'])) {
            header('Location: /users/login');
            die();
        }

        if (!isset($_FILES['formCV']) || !isset($_FILES['formLM']) || $_FILES['formCV']['error'] != 0 || $_FILES['formLM']['error'] != 0) {
            var_dump($_FILES);
            die('Errors with the files');
        }
        if ($_FILES['formCV']['size'] > 2097152 || $_FILES['formLM']['size'] > 2097152) {
            die('File size should be less than 2MB');
        }

        $fileToDatabaseField = [
            'formCV' => 'curriculum_vitae',
            'formLM' => 'motivation_letter'
        ];
        $dbFilesContents = [];

        $this->loadModel("ModelCandidacy");
        foreach ($fileToDatabaseField as $file => $db_field) {
            $ext = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
            $type = $_FILES[$file]['type'];
            if ($type != "application/pdf" || strtolower($ext) != "pdf") {
                die('Files must be PDF, found: type ' . $type . ', ext ' . $ext);
            }

            $dbFilesContents[$db_field] = file_get_contents($_FILES[$file]['tmp_name']);
        }
        $success = $this->ModelCandidacy->createInitial([
            'id_user' => $_SESSION['idUser'],
            'id_internship_offer' => $idInternshipOffer,
            'curriculum_vitae' => $dbFilesContents['curriculum_vitae'],
            'motivation_letter' => $dbFilesContents['motivation_letter']
        ]);

        if ($success) {
            header('Location: /candidacy/index');
        } else {
            die('Error while creating the candidacy');
        }
    }

    public function Index()
    {
        $this->loadModel("ModelCandidacy");
        $candidacies = $this->ModelCandidacy->getAllWithIntershipInformations();
        $this->render('index', ['candidacies' => $candidacies]);
    }

    public function pilotcandidacies()
    {
        $this->loadModel("ModelCandidacy");
        $candidacies = $this->ModelCandidacy->getAllCandidaciesWithIntershipInformations();
        $this->render('pilotcandidacies', ['candidacies' => $candidacies]);
    }
}
