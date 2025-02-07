<?php
// Retire la ligne suivante si elle existe dans ce fichier
// session_start();
?>

<h1>Bienvenue, <?php echo isset($_SESSION['user']) ? $_SESSION['user']['name'] : 'invité'; ?> !</h1>

<!-- Le reste du contenu de la page -->


<h1>Liste des produits</h1>

<?php if (count($products) > 0): ?>
   <ul>
      <?php foreach ($products as $product): ?>
         <li>
            <a href="/product/<?= $product['id']; ?>">
               <img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>" width="100">
               <h2><?= $product['name']; ?></h2>
               <p><?= $product['description']; ?></p>
               <p>Prix : <?= $product['price']; ?> €</p>
            </a>
         </li>
      <?php endforeach; ?>
   </ul>
<?php else: ?>
   <p>Aucun produit disponible.</p>
<?php endif; ?>