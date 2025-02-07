<?php

namespace App\Controllers;

use App\Models\Comment;

session_start(); // Démarre la session ici

class CommentController
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   // Ajouter un commentaire
   // CommentController.php - Exemple de récupération des commentaires avec nom d'utilisateur
   public function addComment($productId)
   {
      // Vérifier si le produit existe avant d'ajouter un commentaire
      $product = new \App\Models\Product($this->pdo);
      $productDetails = $product->getProductById($productId);

      if (!$productDetails) {
         echo "Produit introuvable.";
         return;
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $userId = 1; // ID de l'utilisateur (par exemple, pour un utilisateur fictif)
         $comment = $_POST['comment'];

         // Créer une instance du modèle Comment et ajouter le commentaire
         $commentModel = new \App\Models\Comment($this->pdo);
         $commentModel->addComment($userId, $productId, $comment);

         // Rediriger vers la page du produit après l'ajout du commentaire
         header("Location: /product/$productId");
      }

      // Récupérer les commentaires avec le nom de l'utilisateur
      $commentModel = new \App\Models\Comment($this->pdo);
      $comments = $commentModel->getCommentsWithUserNames($productId);  // Modifier ici pour inclure les noms des utilisateurs

      include '../templates/products/view_product.php';
   }
}
