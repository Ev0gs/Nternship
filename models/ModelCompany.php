<?php
// Inherit from Models abstract class
class ModelCompany extends Models
{

    // Define constructor function
    public function __construct()
    {
        // Set table to the table wanted in database
        $this->table = "company";

        // Call the "getConnection" function to link database
        $this->getConnection();
    }

    public function getAllCompanyInfo()
    {
        try {
            $sql = "SELECT *  
                    FROM " . $this->table . "
                    INNER JOIN located
                    ON located.id_company = company.id_company
                    INNER JOIN address
                    ON address.id_address = located.id_address;";
            $query = $this->_connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getByInternshipId($id)
    {
        try {
            $sql = "SELECT * FROM " . $this->table . " WHERE id_company=(SELECT id_company FROM internship_offer WHERE id_internship_offer=" . $id . ")";
            $query = $this->_connexion->prepare($sql);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT *  
                    FROM " . $this->table . "
                    INNER JOIN located
                    ON located.id_company = company.id_company
                    INNER JOIN address
                    ON address.id_address = located.id_address
                    WHERE company.id_company=" . $id;
            $query = $this->_connexion->prepare($sql);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function Search()
    {
        try {
            $sql = "SELECT * 
                FROM " . $this->table . " 
                INNER JOIN located
                ON located.id_company = company.id_company
                INNER JOIN address
                ON address.id_address = located.id_address
                WHERE company.name_company LIKE '%" . $_POST['InputWhat'] . "%' OR company.activity_sector LIKE '%" . $_POST['InputWhat'] . "%' OR address.city LIKE '%" . $_POST['InputWhere'] . "%' OR address.postal_code LIKE '%" . $_POST['InputWhere'] . "%'";
            $query = $this->_connexion->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function Create()
    {
        try {
            $sql = "INSERT INTO address (city, postal_code, postal_address, additional)
                        VALUES('" . $_POST['InputCity'] . "', '" . $_POST['InputPostalCode'] . "', '" . $_POST['InputAddress'] . "', '" . $_POST['InputAdditional'] . "');
                        INSERT INTO company (name_company, activity_sector, nb_cesi_trainee)
                        VALUES('" . $_POST['InputCompanyName'] . "', '" . $_POST['InputActivitySector'] . "', '" . $_POST['InputNbCesiStudents'] . "');
                        INSERT INTO located (id_company, id_address)
                        VALUES((SELECT MAX(id_company) FROM company), (SELECT MAX(id_address) FROM address));";
            $query = $this->_connexion->prepare($sql);
            if ($query->execute()) {
                echo '<script>alert("Creation of a new company succeeded")</script>';
                header('Location: /Company');
            } else {
                echo '<script>alert("Failed to create company")</script>';
            }
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function Update($id)
    {
        $sql = "UPDATE " . $this->table . " 
                INNER JOIN  
                located  
                ON located.id_company = company.id_company  
                INNER JOIN
                address
                ON address.id_address = located.id_address
                SET company.name_company = '" . $_POST['InputCompanyName'] . "', company.activity_sector = '" . $_POST['InputActivitySector'] . "', company.nb_cesi_trainee = '" . $_POST['InputNbCesiStudents'] . "', address.postal_address = '" . $_POST['InputAddress'] . "', address.city = '" . $_POST['InputCity'] . "', address.postal_code = '" . $_POST['InputPostalCode'] . "', address.additional = '" . $_POST['InputAdditional'] . "'
                WHERE company.id_company =" . $id;
        $query = $this->_connexion->prepare($sql);
        if ($query->execute()) {
            echo '<script>alert("Update of a company succeeded")</script>';
        } else {
            echo '<script>alert("Failed to update company")</script>';
        }
    }

    public function Delete($id)
    {
        try {
            $sql = "DELETE 
                    FROM located
                    WHERE id_company=" . $id . ";
                    DELETE 
                    FROM company
                    WHERE id_company=" . $id . ";";
            $query = $this->_connexion->prepare($sql);
            if ($query->execute()) {
                header('Location: /Company');
            } else {
                echo '<script>alert("Failed to delete an internship offer")</script>';
            }
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function rate($idCompany)
    {
        try {
            $req = $this->_connexion->prepare("SELECT * FROM graduates WHERE id_user = :id_user AND id_company = :id_company");
            $req->execute([
                'id_user' => $_SESSION['idUser'],
                'id_company' => $idCompany
            ]);
            $result = $req->fetch();

            if ($result) {
                header('Location: /Company');
                die();
            }

            $sql = "INSERT INTO graduates
                    set rate = '" . $_POST['InputRate'] . "', id_company =" . $idCompany . ", id_user =" . $_SESSION['idUser'];
            $query = $this->_connexion->prepare($sql);
            if ($query->execute()) {
                header('Location: /Company');
            } else {
                echo '<script>alert("Failed to update internship offer")</script>';
            }
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }

        //verify if a user already rate a company

    }

    public function getAverageRate($id)
    {
        try {
            $sql = "SELECT AVG(rate) as averageRate
                    FROM graduates
                    WHERE id_company =" . $id;
            $query = $this->_connexion->prepare($sql);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC)['averageRate'];
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
