<?php
// Inherit from Models abstract class
class ModelAddress extends Models
{

    private $id_address;
    private $city;
    private $postal_code;
    private $postal_address;
    private $additional;


    // Define constructor function
    public function __construct()
    {
        // Set table to the table wanted in database
        $this->table = "Address";

        // Call the "getConnection" function to link database
        $this->getConnection();
    }

    // Get
    public function getIdAddress()
    {
        return $this->id_address;
    }
    public function getCity()
    {
        return $this->city;
    }
    public function getPostal_code()
    {
        return $this->Postal_code;
    }
    public function getPostal_address()
    {
        return $this->Postal_address;
    }
    public function getadditional()
    {
        return $this->additional;
    }

    // Set
    public function setIdAddress($id_Address)
    {
        $this->id_Address = $id_Address;
    }
    public function setCity($city)
    {
        $this->city = $city;
    }
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
    }
    public function setPostalAddress($postal_address)
    {
        $this->postal_address = $postal_address;
    }
    public function setAdditional($Additional)
    {
        $this->additional = $Additional;
    }


    public function findById(int $id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id_Address=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function Create()
    {
        $sql = "INSERT INTO " . $this->table . "(city, postal_code, postal_address, additional) 
                VALUES ('" . $_POST['Inputcity'] . "', '" . $_POST['Inputpostalcode'] . "', '" . $_POST['Inputpostaladdress'] . "', '" . $_POST['Inputadditional'] . "');";
        $query = $this->_connexion->prepare($sql);
        if ($query->execute()) {
            echo '<script>alert("Creation of a new Address offer succeeded")</script>';
        } else {
            echo '<script>alert("Failed to create Address offer")</script>';
        }
    }

    public function Update(int $id)
    {
        $sql = "UPDATE " . $this->table . " SET ... WHERE id_Address=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }

    public function Delete(int $id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id_Address=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        if ($query->execute()) {
            header('Location: /Address');
        } else {
            echo '<script>alert("Failed to delete an Address ")</script>';
        }
    }
}
