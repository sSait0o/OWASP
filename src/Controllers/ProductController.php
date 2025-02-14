<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Comment;

session_start(); // Début de session à ajouter ici

class ProductController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addProduct()
    {
        // Si la méthode de la requête est POST, ça veut dire qu'un formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // On récupère les données du formulaire
            $name = $_POST['name'];
            $price = $_POST['price'];
            $image = $_POST['image'];
            $description = $_POST['description'];

            // Vérifie si l'utilisateur est connecté
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
            } else {
                // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
                header('Location: /login');
                exit();
            }

            // Création de l'objet Product pour ajouter un produit
            $product = new Product($this->pdo);
            $result = $product->addProduct($name, $price, $image, $description, $userId);

            // Si l'ajout du produit a réussi, rediriger vers une autre page (par exemple la page d'accueil)
            if ($result) {
                // Redirige vers la page des produits ou la page d'accueil
                header('Location: /'); // Ou '/product/list' si tu veux afficher la liste
                exit();
            } else {
                echo "Erreur lors de l'ajout du produit.";
            }
        }

        // Si la méthode est GET, on affiche simplement le formulaire d'ajout
        include '../templates/products/add_product.php';
    }




    public function listProducts()
    {
        $product = new Product($this->pdo);
        $products = $product->getAllProducts();

        var_dump($products); // Debugging: afficher les produits récupérés

        include '../templates/products/list_products.php';
    }


    public function viewProduct($id)
    {
        $product = new Product($this->pdo);
        $productDetails = $product->getProductById($id); // Vérifie que cette fonction retourne un tableau ou false

        if (!$productDetails) {
            echo "Produit non trouvé.";
            return; // Ou rediriger vers une autre page
        }

        // Créer une instance de Comment pour récupérer les commentaires du produit
        $comment = new Comment($this->pdo);
        $comments = $comment->getCommentsByProductId($id);

        include '../templates/products/view_product.php';
    }
}
