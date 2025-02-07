<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   // Ajouter un commentaire
   public function addComment($productId)
   {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $userId = 1; // On met un utilisateur fixe pour l'instant, tu devrais gérer l'authentification
         $commentText = $_POST['comment'];

         $comment = new Comment($this->pdo);
         $comment->addComment($userId, $productId, $commentText);

         // Rediriger vers la page du produit après l'ajout du commentaire
         header("Location: /product/$productId");
      }
   }
}
