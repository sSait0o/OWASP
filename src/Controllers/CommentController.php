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
      // Vérifier si le produit existe avant d'ajouter un commentaire
      $product = new \App\Models\Product($this->pdo);
      $productDetails = $product->getProductById($productId);

      if (!$productDetails) {
         // Si le produit n'existe pas, rediriger ou afficher une erreur
         echo "Produit introuvable.";
         return;
      }

      // Si le produit existe, continuer avec l'ajout du commentaire
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $userId = 1; // ID de l'utilisateur (par exemple, pour un utilisateur fictif)
         $comment = $_POST['comment'];

         // Créer une instance du modèle Comment et ajouter le commentaire
         $commentModel = new \App\Models\Comment($this->pdo);
         $commentModel->addComment($userId, $productId, $comment);

         // Rediriger vers la page du produit après l'ajout du commentaire
         header("Location: /product/$productId");
      }

      // Charger la vue du formulaire de commentaire
      include '../templates/products/view_product.php';
   }
}
