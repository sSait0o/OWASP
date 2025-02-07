<?php

namespace App\Models;

class Comment
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   // Méthode pour ajouter un commentaire
   public function addComment($userId, $productId, $comment)
   {
      $sql = "INSERT INTO comments (user_id, product_id, comment) VALUES (:user_id, :product_id, :comment)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':user_id', $userId);
      $stmt->bindParam(':product_id', $productId);
      $stmt->bindParam(':comment', $comment);
      $stmt->execute();
   }

   // Méthode pour obtenir les commentaires d'un produit par son ID
   public function getCommentsByProductId($productId)
   {
      $sql = "SELECT * FROM comments WHERE product_id = :product_id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindParam(':product_id', $productId, \PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetchAll(); // Retourne tous les commentaires pour ce produit
   }
}
