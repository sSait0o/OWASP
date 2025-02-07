<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Comment;

class ProductController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $image = $_POST['image']; // Idéalement tu devrais gérer l'upload d'image ici
            $description = $_POST['description'];
            $userId = 1; // Utilisateur fixe pour le moment, tu devrais gérer l'authentification

            $product = new Product($this->pdo);
            $product->addProduct($name, $price, $image, $description, $userId);
            header('Location: /'); // Redirection vers la page d'accueil après ajout
        }

        include '../templates/products/add_product.php';
    }

    public function listProducts()
    {
        $product = new Product($this->pdo);
        $products = $product->getAllProducts();
        include '../templates/products/list_products.php';
    }

    public function viewProduct($id)
    {
        $product = new Product($this->pdo);
        $productDetails = $product->getProductById($id);

        // Créer une instance de Comment pour récupérer les commentaires du produit
        $comment = new Comment($this->pdo);
        $comments = $comment->getCommentsByProductId($id);

        // Inclure la vue avec les détails du produit et les commentaires
        include '../templates/products/view_product.php';
    }
}
