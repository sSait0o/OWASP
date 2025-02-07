<?php

namespace App\Models;

use PDO;

class User
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   public function getUserById($id)
   {
      $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   public function createUser($name, $email, $password, $description)
   {
      $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, description) VALUES (:name, :email, :password, :description)");
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
      $stmt->bindParam(':description', $description);
      return $stmt->execute();
   }
}
