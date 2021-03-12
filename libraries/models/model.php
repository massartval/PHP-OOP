<?php 

namespace Models;

abstract class Model {

    protected $pdo;
    protected $table;

    public function __construct() {
        $this->pdo = \Database::getPdo();
    }

    /**
     * Returns list of articles by creation date (newest to oldest)
     * @return array
     */
    public function findAll(?string $order = ""): array {

        // create a dynamic sql
        $sql = "SELECT * FROM {$this->table}";
        // if an order is set, it is added to te sql
        if($order){
            $sql .= " ORDER BY " . $order;
        }

        // On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();
        return $articles;
    }


    public function find(int $id) {

        // On va ici utiliser une requête préparée car elle inclut une variable qui provient de l'utilisateur : Ne faites jamais confiance à ce connard d'utilisateur ! :D
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['id' => $id]);
        // On fouille le résultat pour en extraire les données réelles de l'article
        $item = $query->fetch();
        return $item;
    }
        
    public function delete(int $id): void {

        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    
    }

}

?>