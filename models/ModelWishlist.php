<?php
// Inherit from Models abstract class
class ModelWishlist extends Models
{

    // Define constructor function
    public function __construct()
    {
        // Set table to the table wanted in database
        $this->table = "wishlist";

        // Call the "getConnection" function to link database
        $this->getConnection();
    }

    public function getAllWishlist()
    {
        $sql = "SELECT * FROM " . $this->table . "
            INNER JOIN internship_offer
            ON internship_offer.id_internship_offer = " . $this->table . ".id_internship_offer
            INNER JOIN company
            ON company.id_company = internship_offer.id_company
            INNER JOIN located
            ON company.id_company = located.id_company
            INNER JOIN address
            ON address.id_address = located.id_address
            INNER JOIN promotion
            ON internship_offer.id_promotion = promotion.id_promotion
            INNER JOIN users
            ON users.id_user = " . $this->table . ".id_user
            WHERE " . $this->table . ".id_user = " . $_SESSION['idUser'];
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function remove($idInternshipOffer)
    {
        $sql = "DELETE FROM " . $this->table . "
            WHERE id_user = " . $_SESSION['idUser'] . "
            AND id_internship_offer = " . $idInternshipOffer;
        $query = $this->_connexion->prepare($sql);
        if ($query->execute()) {
            header('Location: /Wishlist');
        } else {
            echo '<script>alert("Failed to delete an internship offer from the wishlist")</script>';
        }
    }

    public function add($idInternshipOffer)
    {

        $req = $this->_connexion->prepare("SELECT * FROM " . $this->table . " WHERE id_user = :id_user AND id_internship_offer = :id_internship_offer");
        $req->execute([
            'id_user' => $_SESSION['idUser'],
            'id_internship_offer' => $idInternshipOffer
        ]);
        $result = $req->fetch();

        if ($result) {
            header('Location: /Wishlist');
            die();
        }

        $sql = "INSERT INTO " . $this->table . " (id_user, id_internship_offer)
                VALUES ('" . $_SESSION['idUser'] . "', '" . $idInternshipOffer . "')";
        $query = $this->_connexion->prepare($sql);
        if ($query->execute()) {
            header('Location: /Wishlist');
        } else {
            echo '<script>alert("Failed to add an internship offer to the wishlist")</script>';
        }
    }
}
