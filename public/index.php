<?php

require_once '../src/Database/database.php';
require_once '../src/Controllers/ProductController.php';
require_once '../src/Controllers/CommentController.php';
require_once '../src/Models/Product.php';
require_once '../src/Models/Comment.php';

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
   $productId = $router[2];  // Récupère l'ID du produit passé dans l'URL

} elseif ($router[0] == 'add_product') {
   // Ajouter un produit
   $controller = new App\Controllers\ProductController($pdo);
   $action = 'addProduct';
}

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
