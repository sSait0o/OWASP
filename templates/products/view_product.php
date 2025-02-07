<h1><?= $productDetails['name']; ?></h1>
<p>Prix: <?= $productDetails['price']; ?>€</p>
<p><?= $productDetails['description']; ?></p>

<h2>Commentaires:</h2>
<ul>
   <?php foreach ($comments as $comment): ?>
      <li><?= $comment['comment']; ?></li>
   <?php endforeach; ?>
</ul>

<form method="POST" action="/comment/add/<?= $productDetails['id']; ?>">
   <textarea name="comment" required></textarea>
   <button type="submit">Ajouter un commentaire</button>
</form>

<h1><?php echo $productDetails['name']; ?></h1>
<p><?php echo $productDetails['description']; ?></p>
<p>Prix : <?php echo $productDetails['price']; ?>€</p>
<img src="<?php echo $productDetails['image']; ?>" alt="Image du produit">

<h2>Commentaires</h2>

<!-- Afficher les commentaires -->
<?php foreach ($comments as $comment): ?>
   <div>
      <strong><?php echo $comment['user_name']; ?>:</strong>
      <p><?php echo $comment['comment']; ?></p>
   </div>
<?php endforeach; ?>

<!-- Formulaire pour ajouter un commentaire -->
<h3>Ajouter un commentaire</h3>
<form action="/comment/<?php echo $productDetails['id']; ?>" method="POST">
   <textarea name="comment" required></textarea><br>
   <button type="submit">Ajouter</button>
</form>