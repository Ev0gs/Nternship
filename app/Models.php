<?php
    // We create a new abstract class that other models will inherit
    abstract class Models
    {
        // Informations on database
        private $host = "localhost";
        private $db_name = "projet_web";
        private $username = "root";
        private $password = "";

        // Variable that will contain the instantiation of connection
        protected $_connexion;

        // Variables allowing custom requests
        public $table;
        

        // Define connection 
        public function getConnection()
        {
            // Delete an old connexion
            $this->_connexion = null;

            
            // Trying to connect database
            try{
                // Instantiation to connect database
                $this->_connexion = new PDO('mysql:host='.$this->host . '; dbname='. $this->db_name, $this->username, $this->password);
            }
            // Catch the errors
            catch(PDOException $exception){
                // Send an error message if there is one
                echo 'Erreur : '. $exception->getMessage();
            }
        }

        // Define function to get all the rows from a table
        public function getAll()
        {
            // Store sql query in $sql
            $sql = "SELECT * FROM ".$this->table;
            // We prepare the sql query before executing in order to protect from sql injections 
            $query = $this->_connexion->prepare($sql);
            // Execute the sql query that has been prepared
            $query->execute();
            // Return the result from the query
            return $query->fetchAll();
        }
    }
?>