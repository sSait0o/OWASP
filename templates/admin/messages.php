<h2>Messages des utilisateurs</h2>

<?php foreach ($messages as $msg): ?>
   <div>
      <strong><?= htmlspecialchars($msg['name']); ?>:</strong>
      <p><?= htmlspecialchars($msg['message']); ?></p>
   </div>
<?php endforeach; ?>