<?php
// Inherit from Models abstract class
class ModelCandidacy extends Models
{

    private $id_candidacy;
    private $motivation_letter;
    private $curriculum_vitae;
    private $validation_doc;
    private $convention;
    private $state;
    private $id_user;
    private $id_intership_offer;

    // Define constructor function
    public function __construct()
    {
        // Set table to the table wanted in database
        $this->table = "Candidacy";

        // Call the "getConnection" function to link database
        $this->getConnection();
    }

    // Get
    public function getIdCandidacy()
    {
        return $this->id_candidacy;
    }
    public function getMotivationLetter()
    {
        return $this->motivation_letter;
    }
    public function getCurriculumVitae()
    {
        return $this->curriculum_vitae;
    }
    public function getValidationDoc()
    {
        return $this->validation_doc;
    }
    public function getConvention()
    {
        return $this->convention;
    }
    public function getState()
    {
        return $this->state;
    }
    public function getIdUser()
    {
        return $this->id_user;
    }
    public function getIdIntershipOffer()
    {
        return $this->id_intership_offer;
    }

    // Set
    public function setIdCandidacy($id_candidacy)
    {
        $this->id_candidacy = $id_candidacy;
    }
    public function setMotivationLetter($motivation_letter)
    {
        $this->motivation_letter = $motivation_letter;
    }
    public function setCurriculumVitae($curriculum_vitae)
    {
        $this->curriculum_vitae = $curriculum_vitae;
    }
    public function setValidationDoc($validation_doc)
    {
        $this->validation_doc = $validation_doc;
    }
    public function setConvention($convention)
    {
        $this->convention = $convention;
    }
    public function setState($state)
    {
        $this->state = $state;
    }
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }
    public function setIdIntershipOffer($id_intership_offer)
    {
        $this->id_intership_offer = $id_intership_offer;
    }


    public function findById(int $id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id_candidacy=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function send()
    {
        // send curriculum_vitae and motivation_letter to the database
        $sql = "INSERT INTO " . $this->table . " (motivation_letter, curriculum_vitae, id_user, id_intership_offer) VALUES (:motivation_letter, :curriculum_vitae, :id_user, :id_intership_offer)";
        $query = $this->_connexion->prepare($sql);
        $query->bindParam(':motivation_letter', $this->motivation_letter);
        $query->bindParam(':curriculum_vitae', $this->curriculum_vitae);
        $query->bindParam(':id_user', $_SESSION['idUser']);
        $query->bindParam(':id_intership_offer', $this->id_intership_offer);
        $query->execute();
    }

    public function read(int $id_user)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id_user=" . $id_user;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function createInitial($data)
    {
        $sql = "INSERT INTO " . $this->table . " SET id_user = :id_user, id_internship_offer = :id_internship_offer, motivation_letter = :motivation_letter, curriculum_vitae = :curriculum_vitae, state = '1'";
        $query = $this->_connexion->prepare($sql);
        $query->bindParam(':id_user', $data['id_user']);
        $query->bindParam(':id_internship_offer', $data['id_internship_offer']);
        $query->bindParam(':motivation_letter', $data['motivation_letter']);
        $query->bindParam(':curriculum_vitae', $data['curriculum_vitae']);
        return $query->execute();
    }

    public function getAllWithIntershipInformations()
    {
        if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin', 'Pilot'])) {
            $sql = "SELECT
                id_candidacy,
                state,
                internship_offer.id_internship_offer,
                offer_title,
                offer_text,
                skills,
                duration,
                salary,
                offer_date,
                IF (motivation_letter IS NULL, '0', '1') AS motivation_letter,
                IF (curriculum_vitae IS NULL, '0', '1') AS curriculum_vitae
            FROM " . $this->table . " INNER JOIN internship_offer ON internship_offer.id_internship_offer = candidacy.id_internship_offer";
        }
        if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Student'])) {
            $sql = "SELECT
                id_candidacy,
                state,
                internship_offer.id_internship_offer,
                offer_title,
                offer_text,
                skills,
                duration,
                salary,
                offer_date,
                IF (motivation_letter IS NULL, '0', '1') AS motivation_letter,
                IF (curriculum_vitae IS NULL, '0', '1') AS curriculum_vitae
            FROM " . $this->table . " INNER JOIN internship_offer ON internship_offer.id_internship_offer = candidacy.id_internship_offer
            WHERE id_user = :id_user";
        }
        $query = $this->_connexion->prepare($sql);
        $query->execute(array('id_user' => $_SESSION['idUser']));
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCandidaciesWithIntershipInformations()
    {
        $sql = "SELECT
            id_candidacy,
            state,
            users.id_user,
            first_name,
            name,
            name_company,
            internship_offer.id_internship_offer,
            offer_title,
            offer_text,
            skills,
            duration,
            salary,
            offer_date,
            IF (motivation_letter IS NULL, '0', '1') AS motivation_letter,
            IF (curriculum_vitae IS NULL, '0', '1') AS curriculum_vitae
        FROM " . $this->table . " INNER JOIN users ON users.id_user = candidacy.id_user INNER JOIN internship_offer ON internship_offer.id_internship_offer = candidacy.id_internship_offer INNER JOIN company ON company.id_company = internship_offer.id_company";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
