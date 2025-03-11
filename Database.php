<?php

class Database {
    private $host = 'localhost';
    private $dbName = 'mangas_bdd';
    private $user = 'root';
    private $password = '';
    private $connection;

  
    public function getConnection() {
        if ($this->connection === null) {
            try {
                $this->connection = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbName}",
                    $this->user,
                    $this->password
                );
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connexion échouée : " . $e->getMessage());
            }
        }
        return $this->connection;
    }
}
?>
