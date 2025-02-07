<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   // Affichage du formulaire d'inscription
   public function showRegisterForm()
   {
      if (isset($_SESSION['user'])) {
         // Si l'utilisateur est déjà connecté, redirige-le vers la page d'accueil
         header("Location: /home");
         exit();
      }

      include '../templates/users/register.php';
   }

   // Inscription d'un utilisateur
   public function register()
   {
      if (isset($_SESSION['user'])) {
         // Si l'utilisateur est déjà connecté, redirige-le vers la page d'accueil
         header("Location: /home");
         exit();
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $name = $_POST['name'];
         $email = $_POST['email'];
         $password = $_POST['password'];

         $userModel = new User($this->pdo);
         if ($userModel->register($name, $email, $password)) {
            header("Location: /login"); // Redirige vers la page de connexion après inscription
            exit();
         } else {
            echo "Erreur lors de l'inscription";
         }
      }

      include '../templates/users/register.php';
   }

   // Connexion de l'utilisateur
   public function login()
   {
      session_start();
      if (isset($_SESSION['user'])) {
         // Si l'utilisateur est déjà connecté, redirige-le vers la page d'accueil
         header("Location: /home");
         exit();
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $email = $_POST['email'];
         $password = $_POST['password'];

         $userModel = new User($this->pdo);
         $user = $userModel->login($email, $password);

         if ($user) {
            // Enregistrer l'utilisateur dans la session
            $_SESSION['user'] = $user;  // On peut aussi stocker son nom ici
            $_SESSION['user_name'] = $user['name'];  // Par exemple, stocke le nom de l'utilisateur
            header("Location: /home"); // Redirige vers la page d'accueil après connexion
            exit();
         } else {
            echo "Identifiants incorrects";
         }
      }

      include '../templates/users/login.php';
   }


   public function logout()
   {
      session_destroy(); // Détruire la session
      header("Location: /login"); // Redirige vers la page de connexion
      exit();
   }
}
