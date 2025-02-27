<?php

// Démarre la session
session_start();

// Inclure les fichiers nécessaires
require_once '../src/Database/database.php';
require_once '../src/Controllers/ProductController.php';
require_once '../src/Controllers/CommentController.php';
require_once '../src/Models/Product.php';
require_once '../src/Models/Comment.php';
require_once '../src/Controllers/UserController.php';
require_once '../src/Controllers/MessageController.php';
require_once '../src/Models/Message.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Test de la connexion
if (!$pdo) {
   die("Erreur de connexion à la base de données");
}

// Récupérer les paramètres de la route
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = trim($url, '/');

$router = explode('/', $url);

// Contrôleur et méthode
$controller = null;
$action = null;

include '../templates/partials/header.php';

// Définir les routes
if (empty($router[0]) || $router[0] == 'home') {
   // Page d'accueil : Afficher la liste des produits
   $controller = new App\Controllers\ProductController($pdo);
   $action = 'listProducts';
} elseif ($router[0] == 'product' && isset($router[1])) {
   // Afficher un produit spécifique
   $controller = new App\Controllers\ProductController($pdo);
   $action = 'viewProduct';
   $productId = $router[1];
} elseif ($router[0] == 'comment' && $router[1] == 'add' && isset($router[2])) {
   // Ajouter un commentaire pour un produit
   $controller = new App\Controllers\CommentController($pdo);
   $action = 'addComment';
   $productId = $router[2];
} elseif ($router[0] == 'product' && $router[1] == 'add') {
   // Ajouter un produit
   $controller = new App\Controllers\ProductController($pdo);
   $action = 'addProduct';
} elseif ($router[0] == 'register') {
   // Page d'inscription
   $controller = new App\Controllers\UserController($pdo);
   $action = 'register';
} elseif ($router[0] == 'login') {
   // Page de connexion
   $controller = new App\Controllers\UserController($pdo);
   $action = 'login';
} elseif ($router[0] == 'logout') {
   // Déconnexion
   $controller = new App\Controllers\UserController($pdo);
   $action = 'logout';
} elseif ($router[0] == 'support') {
   // Page pour envoyer un message au support
   $controller = new App\Controllers\MessageController($pdo);
   $action = 'sendMessage';
} elseif ($router[0] == 'admin' && $router[1] == 'messages') {
   // Page admin pour voir les messages
   $controller = new App\Controllers\MessageController($pdo);
   $action = 'viewMessages';
}


include '../templates/partials/footer.php';

// Exécuter l'action du contrôleur
if ($controller && $action) {
   if (isset($productId)) {
      $controller->$action($productId);
   } else {
      $controller->$action();
   }
} else {
   echo "Page non trouvée";
}
