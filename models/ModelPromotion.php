<?php
// Inherit from Models abstract class
class ModelPromotion extends Models
{

    // Define constructor function
    public function __construct()
    {
        // Set table to the table wanted in database
        $this->table = "promotion";

        // Call the "getConnection" function to link database
        $this->getConnection();
    }

    public function findAll($id)
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id_promotion=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function getByInternshipId($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id_promotion=(SELECT id_promotion FROM internship_offer WHERE id_internship_offer=" . $id . ")";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}
