<?php 

namespace Models;

class Comment extends Model {
    protected $table = "comments";

    /**
     * Returns list of comments for a given article
     * @param integer $article_id
     * @return array
     */
    public function findAllWithArticle(int $article_id): array {

        // Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();
        return $commentaires;
    }

    public function insert(string $author, string $content, int $article_id): void {

        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    
    }
}

?>