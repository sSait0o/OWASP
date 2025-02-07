<?php

namespace App\Models;

class Comment
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   // Ajouter un commentaire à un produit
   public function addComment($userId, $productId, $commentText)
   {
      $sql = "INSERT INTO comments (user_id, product_id, comment) VALUES (:user_id, :product_id, :comment)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':user_id', $userId);
      $stmt->bindParam(':product_id', $productId);
      $stmt->bindParam(':comment', $commentText);

      $stmt->execute();
   }

   // Récupérer tous les commentaires pour un produit
   public function getCommentsByProductId($productId)
   {
      $sql = "SELECT comments.comment, users.name as user_name 
                FROM comments 
                JOIN users ON comments.user_id = users.id 
                WHERE product_id = :product_id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':product_id', $productId);
      $stmt->execute();

      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
   }
}
