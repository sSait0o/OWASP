<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <title>Connexion</title>
</head>

<body>
   <h1>Connexion</h1>
   <form action="/login" method="POST">
      <label for="email">Email:</label>
      <input type="email" name="email" required><br>

      <label for="password">Mot de passe:</label>
      <input type="password" name="password" required><br>

      <button type="submit">Se connecter</button>
   </form>
</body>

</html>