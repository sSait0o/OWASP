<?php

namespace App\Models;

use PDO;

class Comment
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   // Récupérer les commentaires d'un produit donné
   public function getCommentsByProductId($productId)
   {
      $stmt = $this->pdo->prepare("SELECT comments.*, users.name AS user_name 
                                     FROM comments 
                                     JOIN users ON comments.user_id = users.id 
                                     WHERE product_id = :productId");
      $stmt->bindParam(':productId', $productId);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   // Ajouter un commentaire
   public function addComment($userId, $productId, $comment)
   {
      $stmt = $this->pdo->prepare("INSERT INTO comments (user_id, product_id, comment) 
                                     VALUES (:user_id, :product_id, :comment)");
      $stmt->bindParam(':user_id', $userId);
      $stmt->bindParam(':product_id', $productId);
      $stmt->bindParam(':comment', $comment);

      return $stmt->execute();
   }
}
