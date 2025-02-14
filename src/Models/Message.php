<?php

namespace App\Models;

use PDO;

class Message
{
   private $pdo;

   public function __construct($pdo)
   {
      $this->pdo = $pdo;
   }

   public function addMessage($userId, $message)
   {
      $stmt = $this->pdo->prepare("INSERT INTO messages (user_id, message) VALUES (:user_id, :message)");
      $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
      $stmt->bindParam(':message', $message);
      return $stmt->execute();
   }

   public function getAllMessages()
   {
      $stmt = $this->pdo->prepare("SELECT messages.*, users.name FROM messages 
                                     JOIN users ON messages.user_id = users.id 
                                     ORDER BY messages.created_at DESC");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}
