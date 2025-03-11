<?php

class Auteur {
    public $id;
    public $nom;

    
    public function __construct($nom) {
        $this->nom = $nom;
    }

    public function enregistrer() {
        $db = new Database();
        $stmt = $db->getConnection()->prepare("INSERT INTO auteurs (nom) VALUES (?)");
        $stmt->execute([$this->nom]);
        $this->id = $db->getConnection()->lastInsertId(); 
    }

    public static function trouverParId($id) {
        $db = new Database();
        $stmt = $db->getConnection()->prepare("SELECT * FROM auteurs WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return new Auteur($row['nom']);
    }
}
