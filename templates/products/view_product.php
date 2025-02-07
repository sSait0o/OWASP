<h1><?= $productDetails['name']; ?></h1>
<p>Prix: <?= $productDetails['price']; ?>€</p>
<p><?= $productDetails['description']; ?></p>

<!-- Affichage de l'image du produit -->
<img src="<?= $productDetails['image']; ?>" alt="Image du produit">

<h2>Commentaires:</h2>
<!-- Affichage des commentaires -->
<?php if (!empty($comments)): ?>
   <?php foreach ($comments as $comment): ?>
      <div>
         <strong><?= htmlspecialchars($comment['user_name']); ?>:</strong>
         <p><?= htmlspecialchars($comment['comment']); ?></p>
      </div>
   <?php endforeach; ?>
<?php else: ?>
   <p>Aucun commentaire pour ce produit.</p>
<?php endif; ?>

<!-- Formulaire pour ajouter un commentaire -->
<h3>Ajouter un commentaire</h3>
<form method="POST" action="/comment/add/<?= $productDetails['id']; ?>">
   <textarea name="comment" required></textarea><br>
   <button type="submit">Ajouter</button>
</form>