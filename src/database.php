<?php
// Charger les dépendances via Composer
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;

// Charger les variables d'environnement du fichier .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Récupérer les variables d'environnement
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];

// Essaie de se connecter à la base de données avec PDO
try {
   // Créer une nouvelle instance de PDO pour la connexion à MySQL
   $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
   // Définir les attributs pour les erreurs PDO
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   echo "Connexion réussie à la base de données !"; // Optionnel, à enlever en production
} catch (PDOException $e) {
   // Si la connexion échoue, afficher un message d'erreur
   die("Erreur de connexion : " . $e->getMessage());
}
