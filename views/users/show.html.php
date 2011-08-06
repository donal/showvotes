<?php
// available vars:
// $id - id as passed in through the URL
// $user - user retrieved from the db if it exists
?>
<html>
<body>
  <?php if (isset($template->user)): ?>
    <h2>This is the show page for the user "<?php echo $template->user->username; ?>" and the id "<?php echo $template->user->id; ?>"</h2>
  <?php else: ?>
    <h2>The user with id "<?php echo $template->id; ?>" does not exist</h2>
  <?php endif; ?>
</body>
</html>
