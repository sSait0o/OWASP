<?php

namespace App\Controllers;

session_start(); // Assure-toi que la session est bien démarrée au début du fichier


use App\Models\Message;



class MessageController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function sendMessage()
    {

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login"); // Redirige uniquement vers /login si l'utilisateur n'est pas connecté
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = $_POST['message'];
            $userId = $_SESSION['user_id'];

            $messageModel = new Message($this->pdo);
            $messageModel->addMessage($userId, $message);

            header("Location: /support?success=1"); // Redirige vers la même page après envoi
            exit();
        }

        include '../templates/users/contact.php'; // Affiche le formulaire
    }


    public function viewMessages()
    {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            echo "Accès refusé.";
            exit();
        }

        $messageModel = new Message($this->pdo);
        $messages = $messageModel->getAllMessages();

        include '../templates/admin/messages.php';
    }
}
