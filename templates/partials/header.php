<!DOCTYPE html>
<html>
<head>
    <title>ValoResell</title>
    <link rel="stylesheet" type="text/css" href="css/utils.css">
</head>
<body>
    <header>
        <h1>ValoResell</h1>
        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="add_product">+</a></li>
                    <li><a href="logout">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="login">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div class="body"