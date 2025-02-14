<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <title>Inscription</title>
</head>

<body>
   <h1>Inscription</h1>
   <form action="/register" method="POST">
      <label for="name">Nom:</label>
      <input type="text" name="name" required><br>

      <label for="email">Email:</label>
      <input type="email" name="email" required><br>

      <label for="password">Mot de passe:</label>
      <input type="password" name="password" required><br>

      <button type="submit">S'inscrire</button>
   </form>
</body>

</html>