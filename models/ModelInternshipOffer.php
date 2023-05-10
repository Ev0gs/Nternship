<?php
// Inherit from Models abstract class
class ModelInternshipOffer extends Models
{

    private $id_internship_offer;
    private $offer_title;
    private $offer_text;
    private $skills;
    private $duration;
    private $salary;
    private $offer_date;
    private $nb_available_places;
    private $id_address;

    // Define constructor function
    public function __construct()
    {
        // Set table to the table wanted in database
        $this->table = "internship_offer";

        // Call the "getConnection" function to link database
        $this->getConnection();
    }

    public function getInfoInternshipOffer()
    {
        $sql = "SELECT internship_offer.id_internship_offer, internship_offer.offer_title, internship_offer.offer_text, internship_offer.skills, internship_offer.duration, internship_offer.salary, internship_offer.offer_date, internship_offer.nb_avilable_places, company.name_company, company.activity_sector, company.nb_cesi_trainee, address.city, address.postal_code, address.postal_address, address.additional, promotion.name_promotion
                FROM " . $this->table . " 
                INNER JOIN company 
                ON internship_offer.id_company = company.id_company
                INNER JOIN located 
                ON company.id_company = located.id_company 
                INNER JOIN address
                ON located.id_address = address.id_address
                INNER JOIN promotion
                ON promotion.id_promotion = internship_offer.id_promotion;
            ";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function mostRecent()
    {
        $sql = "SELECT * FROM " . $this->table . " 
            INNER JOIN company 
                ON internship_offer.id_company = company.id_company
                INNER JOIN located 
                ON company.id_company = located.id_company 
                INNER JOIN address
                ON located.id_address = address.id_address
                INNER JOIN promotion
                ON promotion.id_promotion = internship_offer.id_promotion  
                ORDER BY offer_date DESC";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function search()
    {
        $sql = "SELECT * 
            FROM " . $this->table . " 
            INNER JOIN company 
            ON internship_offer.id_company = company.id_company
            INNER JOIN located 
            ON company.id_company = located.id_company 
            INNER JOIN address
            ON located.id_address = address.id_address
            INNER JOIN promotion
            ON promotion.id_promotion = internship_offer.id_promotion
            WHERE offer_text LIKE '%" . $_POST['InputWhat'] . "%' OR offer_title LIKE '%" . $_POST['InputWhat'] . "%' OR offer_text LIKE '%" . $_POST['InputWhere'] . "%' OR city LIKE '%" . $_POST['InputWhere'] . "%'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function findById(int $id)
    {
        $sql = "SELECT internship_offer.id_internship_offer, internship_offer.offer_title, internship_offer.offer_text, internship_offer.skills, internship_offer.duration, internship_offer.salary, internship_offer.offer_date, internship_offer.nb_avilable_places, company.name_company, company.activity_sector, company.nb_cesi_trainee, address.city, address.postal_code, address.postal_address, address.additional, promotion.name_promotion
                FROM " . $this->table . " 
                INNER JOIN company 
                ON internship_offer.id_company = company.id_company
                INNER JOIN located 
                ON company.id_company = located.id_company 
                INNER JOIN address
                ON located.id_address = address.id_address
                INNER JOIN promotion
                ON promotion.id_promotion = internship_offer.id_promotion
                WHERE internship_offer.id_internship_offer = " . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function Create()
    {
        $offerText = strval($_POST['InputOfferText']);
        $sql = "INSERT INTO " . $this->table . "(offer_title, offer_text, skills, duration, salary, offer_date, nb_avilable_places, id_company, id_promotion) 
                VALUES ('" . $_POST['InputOfferTitle'] . "', '" . $offerText . "', '" . $_POST['InputSkills'] . "', '" . $_POST['InputDuration'] . "', '" . $_POST['InputSalary'] . "', '" . $_POST['InputOfferDate'] . "', '" . $_POST['InputNbPlaces'] . "', (SELECT id_company FROM company WHERE name_company='" . $_POST['InputIdCompany'] . "'), (SELECT id_promotion FROM promotion WHERE name_promotion='" . $_POST['InputIdPromotion'] . "'));";
        $query = $this->_connexion->prepare($sql);
        if ($query->execute()) {
            echo '<script>alert("Creation of a new internship offer succeeded")</script>';
        } else {
            echo '<script>alert("Failed to create internship offer")</script>';
        }
    }

    public function Update(int $id)
    {
        $sql = "UPDATE " . $this->table . " 
            SET offer_title='" . $_POST['InputOfferTitle'] . "', offer_text='" . $_POST['InputOfferText'] . "', skills='" . $_POST['InputSkills'] . "', duration='" . $_POST['InputDuration'] . "', salary='" . $_POST['InputSalary'] . "', offer_date='" . $_POST['InputOfferDate'] . "', nb_avilable_places='" . $_POST['InputNbPlaces'] . "', id_company=(SELECT id_company FROM company WHERE name_company='" . $_POST['InputIdCompany'] . "'), id_promotion=(SELECT id_promotion FROM promotion WHERE name_promotion='" . $_POST['InputIdPromotion'] . "') 
            WHERE id_internship_offer=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }

    public function Delete(int $id)
    {
        $sql = "DELETE FROM candidacy WHERE id_internship_offer=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $sql = "DELETE FROM wishlist WHERE id_internship_offer=" . $id;
        $query = $this->_connexion->prepare($sql);
        if ($query->execute()) {
            $sql = "DELETE FROM " . $this->table . " WHERE id_internship_offer=" . $id;
            $query = $this->_connexion->prepare($sql);
            if ($query->execute()) {
                header('Location: /InternshipOffer');
            } else {
                echo '<script>alert("Failed to delete an internship offer")</script>';
            }
        }
    }
}
