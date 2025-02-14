<?php

namespace App\Models;

use PDO;

class Product
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   public function addProduct($name, $price, $image, $description, $userId)
   {
      try {
         // Préparer la requête SQL pour ajouter un produit
         $stmt = $this->pdo->prepare("INSERT INTO products (name, price, image, description, user_id) 
                                        VALUES (:name, :price, :image, :description, :user_id)");

         // Lier les paramètres
         $stmt->bindParam(':name', $name);
         $stmt->bindParam(':price', $price);
         $stmt->bindParam(':image', $image);
         $stmt->bindParam(':description', $description);
         $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

         // Debugging: voir si la requête est prête à être exécutée
         echo "Exécution de la requête d'ajout...";

         // Exécuter la requête
         if ($stmt->execute()) {
            echo "Produit ajouté avec succès !";
            return true; // Si l'insertion est réussie
         } else {
            throw new \Exception('L\'ajout du produit a échoué.');
         }
      } catch (\PDOException $e) {
         // Afficher l'erreur PDO si la requête échoue
         echo "Erreur PDO: " . $e->getMessage();
         return false;
      } catch (\Exception $e) {
         // Afficher toute autre exception
         echo "Erreur: " . $e->getMessage();
         return false;
      }
   }


   public function getAllProducts()
   {
      try {
         $stmt = $this->pdo->prepare("SELECT * FROM products");
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (\PDOException $e) {
         echo "Erreur PDO: " . $e->getMessage();
         return [];
      }
   }

   public function getProductById($id)
   {
      try {
         $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
         $stmt->execute(['id' => (int)$id]);  // Assurez-vous que l'ID est un entier
         return $stmt->fetch();
      } catch (\PDOException $e) {
         echo "Erreur PDO: " . $e->getMessage();
         return null;
      }
   }
}
