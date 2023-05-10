<?php
// Create a new class for the controller (that will be linked to the "users" table in our case)
class Users extends Controller
{
    // Define a public function
    public function index()
    {
        // Loading the model who match with the table used
        $this->loadModel("ModelUsers");

        // Store the return value from the query that has been executed
        if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin']))
        {
            $users = $this->ModelUsers->getAll();
        }
        if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Pilot']))
        {
            $users = $this->ModelUsers->getAllButPilotAndAdmin();
        }

        // Sending data to the view
        $this->render('index', ['users' => $users]);
    }

    public function Student()
    {
        $this->loadModel("ModelUsers");
        $users = $this->ModelUsers->Student();
        $this->render('index', ['users' => $users]);
    }

    public function Delegate()
    {
        $this->loadModel("ModelUsers");
        $users = $this->ModelUsers->Delegate();
        $this->render('index', ['users' => $users]);
    }

    public function Pilot()
    {
        $this->loadModel("ModelUsers");
        $users = $this->ModelUsers->Pilot();
        $this->render('index', ['users' => $users]);
    }

    public function Search()
    {
        $form = new Form;
        if (Form::validate($_POST, ['InputSearchName'])) {
            $this->loadModel("ModelUsers");
            if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin']))
            {
                $Users = $this->ModelUsers->search();
            }
            if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Pilot']))
            {
                $Users = $this->ModelUsers->searchButPilotAndAdmin();
            }
            $this->render('index', ['users' => $Users]);
        } else {
            echo '<script>alert("You may fill all the search inputs before submiting!")</script>';
        }
    }

    public function Read($id)
    {
        $this->loadModel("ModelUsers");
        $this->loadModel("ModelPromotion");
        $user = $this->ModelUsers->findById($id);
        $promotion = $this->ModelPromotion->getById($user['id_promotion']);
        $this->render('read', ['user' => $user, 'promotion' => $promotion]);
    }

    public function Create()
    {
        if (Form::validate($_POST, ['name', 'firstname', 'phonenumber', 'email', 'birthdate', 'gender', 'campus', 'role', 'password', 'InputIdPromotion'])) {
            $this->loadModel("ModelUsers");
            $this->ModelUsers->create();
        }

        $this->loadModel("ModelCompany");
        $CompaniesName = $this->ModelCompany->getAll();
        $this->loadModel("ModelPromotion");
        $PromotionName = $this->ModelPromotion->getAll();
        $this->render2data('create', ['CompaniesName' => $CompaniesName], ['PromotionName' => $PromotionName]);
    }

    public function Delete($id)
    {
        $this->loadModel("ModelUsers");
        $users = $this->ModelUsers->Delete($id);
        header('Location: /users/index');
        die();
    }

    public function login()
    {
        $this->loadModel("ModelUsers");
        $form = new FORM;
        if (Form::validate($_POST, ['email', 'password'])) {
            $idUser = $this->ModelUsers->getUserIdAndRoleFromEmail();
            $_SESSION['idUser'] = $idUser['id_user'];
            $_SESSION['role'] = $idUser['role'];
            // Cookie available during 1 hour
            setcookie("roleUser", $idUser["role"], time() + 3600);

            // Calling login method
            $this->ModelUsers->login();
        }
        $this->render('login');
    }

    public function Logout()
    {
        $this->loadModel("ModelUsers");
        session_destroy();
        session_unset();
        $this->ModelUsers->logout();
    }

    public function edit($id)
    {
        $this->loadModel("ModelUsers");
        $this->loadModel("ModelPromotion");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ModelUsers->Update($id);
            header('Location: /users/index');
            die();
        }
        $users = $this->ModelUsers->findById($id);
        $promotions = $this->ModelPromotion->findAll($id);
        return $this->render("edit", ['users' => $users, 'promotions' => $promotions]);
    }
}
