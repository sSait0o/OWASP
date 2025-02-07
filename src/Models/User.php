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

   // Inscription d'un utilisateur
   public function register($name, $email, $password)
   {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hachage du mot de passe

      $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $hashedPassword);

      return $stmt->execute();
   }

   // Connexion d'un utilisateur
   public function login($email, $password)
   {
      $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
      $stmt->bindParam(':email', $email);
      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user && password_verify($password, $user['password'])) {
         return $user; // Retourner les informations de l'utilisateur si la connexion est valide
      }

      return false; // Connexion échouée
   }

   // Récupérer un utilisateur par son ID
   public function getUserById($id)
   {
      $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();

      return $stmt->fetch(PDO::FETCH_ASSOC);
   }
}
