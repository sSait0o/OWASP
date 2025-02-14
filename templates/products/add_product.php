<form method="POST" action="/product/add">
   <label for="name">Nom du produit:</label>
   <input type="text" name="name" id="name" required>

   <label for="price">Prix:</label>
   <input type="number" name="price" id="price" required>

   <label for="image">Image (URL):</label>
   <input type="text" name="image" id="image" required>

   <label for="description">Description:</label>
   <textarea name="description" id="description" required></textarea>

   <button type="submit">Ajouter le produit</button>
</form>