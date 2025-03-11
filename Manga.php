<?php

class Manga {
    public $id;
    public $titre;
    public $description;
    public $annee_sortie;
    public $auteur;

    
    public function __construct($titre, $description, $annee_sortie, Auteur $auteur) {
        $this->titre = $titre;
        $this->description = $description;
        $this->annee_sortie = $annee_sortie;
        $this->auteur = $auteur;
    }

    public function enregistrer() {
        $db = new Database();
        $stmt = $db->getConnection()->prepare(
            "INSERT INTO mangas (titre, description, annee_sortie, auteur_id) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$this->titre, $this->description, $this->annee_sortie, $this->auteur->id]);
    }

    public static function tous() {
        $db = new Database();
        $stmt = $db->getConnection()->query("SELECT * FROM mangas");
        $mangas = [];
        while ($row = $stmt->fetch()) {
           
            $auteur = Auteur::trouverParId($row['auteur_id']);
            $mangas[] = new Manga($row['titre'], $row['description'], $row['annee_sortie'], $auteur);
        }
        return $mangas;
    }
}
?>
