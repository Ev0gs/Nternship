<?php
// Inherit from Models abstract class
class ModelUsers extends Models
{

    private $id_user;
    private $name;
    private $first_name;
    private $phone_number;
    private $Email;
    private $birthdate;
    private $gender;
    private $campus;
    private $role;
    private $password;

    // Define constructor function
    public function __construct()
    {
        // Set table to the table wanted in database
        $this->table = "users";

        // Call the "getConnection" function to link database
        $this->getConnection();
    }

    // Get
    public function getIdUser()
    {
        return $this->id_user;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getFirstName()
    {
        return $this->first_name;
    }
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }
    public function getEmail()
    {
        return $this->Email;
    }
    public function getBirthdate()
    {
        return $this->birthdate;
    }
    public function getGender()
    {
        return $this->gender;
    }
    public function getCampus()
    {
        return $this->campus;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getPassword()
    {
        return $this->password;
    }

    // Set
    public function setIduser($id_user)
    {
        $this->id_users = $id_user;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setfirstname($first_name)
    {
        $this->first_name = $first_name;
    }
    public function setphonenumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }
    public function setbirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    public function setCampus($campus)
    {
        $this->campus = $campus;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setIdAddress($id_assdress)
    {
        $this->id_address = $id_assdress;
    }

    public function findById(int $id)
    {
        $sql = "SELECT * FROM " . $this->table . " INNER JOIN address on address.id_address = users.id_address WHERE id_user=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function create()
    {

        try {

            $sql = "INSERT INTO address(city, postal_code, postal_address, additional) VALUES (:city, :postalcode, :postaladdress, :additional)";

            $stmt = $this->_connexion->prepare($sql);
            $stmt->bindParam(':city', $_POST['city']);
            $stmt->bindParam(':postalcode', $_POST['postalcode']);
            $stmt->bindParam(':postaladdress', $_POST['postaladdress']);
            $stmt->bindParam(':additional', $_POST['additional']);
            $stmt->execute();
            $id_adress = $this->_connexion->lastInsertId();

            $sql = "INSERT INTO " . $this->table . "(name, first_name, phone_number, Email, birthdate, gender, campus, role, password, id_address, id_promotion) VALUES (:name, :firstname, :phone_number, :email, :birthdate, :gender, :campus, :role, :password, :id_adress, :id_promotion)";
            $stmt = $this->_connexion->prepare($sql);
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->bindParam(':firstname', $_POST['firstname']);
            $stmt->bindParam(':phone_number', $_POST['phonenumber']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':birthdate', $_POST['birthdate']);
            $stmt->bindParam(':gender', $_POST['gender']);
            $stmt->bindParam(':campus', $_POST['campus']);
            $stmt->bindParam(':role', $_POST['role']);
            $password_encrypt = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $password_encrypt);
            $stmt->bindParam(':id_adress', $id_adress);
            $stmt->bindParam(':id_promotion', $_POST['InputIdPromotion']);
            $stmt->execute();

            $user_id = $this->_connexion->lastInsertId();

            echo "User created with id : " . $user_id;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function Update(int $id)
    {
        $sql = "UPDATE " . $this->table . " INNER JOIN address on address.id_address = users.id_address 
            SET name='" . $_POST['name'] . "', first_name='" . $_POST['firstname'] . "', phone_number='" . $_POST['phonenumber'] . "', Email='" . $_POST['email'] . "', birthdate='" . $_POST['birthdate'] . "', gender='" . $_POST['gender'] . "', campus='" . $_POST['campus'] . "', role='" . $_POST['role'] . "', city='" . $_POST['city'] . "', postal_code='" . $_POST['postalcode'] . "', postal_address='" . $_POST['postaladdress'] . "', additional='" . $_POST['additional'] . "', id_promotion='" . $_POST['InputIdPromotion'] . "'";

        if ($_POST['password'] != "") {
            $password_encrypt = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql .= ", password='" . $password_encrypt . "'";
        }

        $sql .= " WHERE id_user=" . $id;

        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }


    public function delete(int $id)
    {
        $sql = "DELETE FROM candidacy WHERE id_user=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $sql = "DELETE FROM wishlist WHERE id_user=" . $id;
        $query = $this->_connexion->prepare($sql);
        if ($query->execute()) {
            $sql = "DELETE FROM " . $this->table . " WHERE id_user=" . $id;
            $query = $this->_connexion->prepare($sql);
            if ($query->execute()) {
                header('Location: /index');
            } else {
                echo '<script>alert("Failed to delete a user")</script>';
            }
        }
    }

    public function  login()
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->execute();

        $user = $stmt->fetch();
        if ($user) {
            if (password_verify($_POST['password'], $user['password'])) {
                // echo "user found and password correct";
                header('Location: /');
                die();
            } else {
                echo "password does not match";
            }
        } else {
            echo "user not found";
        }
    }

    public function getUserIdAndRoleFromEmail()
    {
        $sql = "SELECT id_user, role FROM " . $this->table . " WHERE email = :email";
        $query = $this->_connexion->prepare($sql);
        $query->bindParam(':email', $_POST['email']);
        $query->execute();
        return $query->fetch();
    }

    public function search()
    {
        $sql = "SELECT * 
            FROM " . $this->table . "  
            WHERE name LIKE '%" . $_POST['InputSearchName'] . "%' AND first_name LIKE '%" . $_POST['InputSearchFirst'] . "%'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function searchButPilotAndAdmin()
    {
        $sql = "SELECT * 
            FROM " . $this->table . "  
            WHERE name LIKE '%" . $_POST['InputSearchName'] . "%' AND first_name LIKE '%" . $_POST['InputSearchFirst'] . "%' AND role != 'Pilot' AND role != 'Admin'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function Student()
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE role = 'Student'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function Pilot()
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE role = 'Pilot'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function Delegate()
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE role = 'Delegate'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllButPilotAndAdmin()
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE role = 'Student' OR role = 'Delegate'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    //logout function

    public function logout()
    {
        session_destroy();
        header('Location: /');
    }
}
