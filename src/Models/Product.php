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
      $stmt = $this->pdo->prepare("INSERT INTO products (name, price, image, description, user_id) VALUES (:name, :price, :image, :description, :user_id)");
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':price', $price);
      $stmt->bindParam(':image', $image);
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
      return $stmt->execute();
   }
   public function getAllProducts()
   {
      // Requête pour récupérer tous les produits
      $stmt = $this->pdo->prepare("SELECT * FROM products");
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function getProductById($id)
   {
      $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }
}
