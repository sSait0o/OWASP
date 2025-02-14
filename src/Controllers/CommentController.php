<?php


namespace App\Controllers;

session_start(); // Assure-toi que la session est bien démarrée au début du fichier


use App\Models\Comment;

session_start(); // Démarre la session pour récupérer l'utilisateur connecté

if (!isset($_SESSION['user_id'])) {
   echo "Erreur : Vous devez être connecté pour commenter.";
   return;
}

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
      if (!isset($_SESSION['user_id'])) {
         echo "Erreur : Vous devez être connecté pour commenter.";
         return;
      }

      $userId = $_SESSION['user_id']; // ID de l'utilisateur connecté
      $product = new \App\Models\Product($this->pdo);
      $productDetails = $product->getProductById($productId);

      if (!$productDetails) {
         echo "Produit introuvable.";
         return;
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $comment = trim($_POST['comment']);

         if (empty($comment)) {
            echo "Erreur : Le commentaire ne peut pas être vide.";
            return;
         }

         // Créer une instance du modèle Comment et ajouter le commentaire
         $commentModel = new \App\Models\Comment($this->pdo);
         $commentModel->addComment($userId, $productId, $comment);

         // Rediriger vers la page du produit après l'ajout du commentaire
         header("Location: /product/$productId");
         exit();
      }

      // Récupérer les commentaires avec le nom de l'utilisateur
      $commentModel = new \App\Models\Comment($this->pdo);
      $comments = $commentModel->getCommentsWithUserNames((int) $productId);

      include '../templates/products/view_product.php';
   }
}
