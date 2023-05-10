<?php
// Create a new class for the controller
class Company extends Controller
{
    // Define a public function
    public function Index()
    {
        // Loading the model who match with the table used
        $this->loadModel("ModelCompany");

        // Store the return value from the query that has been executed
        $companies = $this->ModelCompany->getAllCompanyInfo();
        foreach ($companies as $key => $company) {
            $companies[$key]['averageRate'] = $this->ModelCompany->getAverageRate($company['id_company']);
        }

        // Sending data to the view
        $this->render('index', ['companies' => $companies]);
    }

    public function Search()
    {
        $form = new Form;
        if (Form::validate($_POST, ['InputWhat', 'InputWhere'])) {
            $this->loadModel("ModelCompany");
            $companies = $this->ModelCompany->Search();
            foreach ($companies as $key => $company) {
                $companies[$key]['averageRate'] = $this->ModelCompany->getAverageRate($company['id_company']);
            }
            $this->render('index', ['companies' => $companies]);
        } else {
            echo '<script>alert("You may fill all the search inputs before submiting!")</script>';
        }
    }

    public function Create()
    {
        $form = new Form;
        if (Form::validate($_POST, ['InputCompanyName', 'InputActivitySector', 'InputNbCesiStudents', 'InputAddress', 'InputCity', 'InputPostalCode'])) {
            $this->loadModel("ModelCompany");
            $this->ModelCompany->Create();
        }
        $this->render('create');
    }

    public function Read($id)
    {
        $this->loadModel("ModelCompany");
        $Company = $this->ModelCompany->getById($id);
        $this->render('read', ['Company' => $Company]);
    }

    public function Edit($id)
    {
        $this->loadModel("ModelCompany");
        $form = new Form;
        if (Form::validate($_POST, ['InputCompanyName', 'InputActivitySector', 'InputNbCesiStudents', 'InputAddress', 'InputCity', 'InputPostalCode'])) {
            $this->ModelCompany->Update($id);
            header('Location: /Company');
            die();
        }
        $Company = $this->ModelCompany->getById($id);
        $this->render('edit', ['Company' => $Company]);
    }

    public function Delete($id)
    {
        $this->loadModel("ModelCompany");
        $this->ModelCompany->Delete($id);
    }

    public function Rate($id_company)
    {
        $this->loadModel("ModelCompany");
        $Company = $this->ModelCompany->getById($id_company);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ModelCompany->Rate($id_company);
        }
        $this->render('rate', ['Company' => $Company]);
    }

    public function getAverageRate($id)
    {
        $this->loadModel("ModelCompany");
        $this->ModelCompany->getAverageRate($id);
    }
}
