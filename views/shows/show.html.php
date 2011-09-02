<?php
// available vars:
// $id - id as passed in through the URL
// $show - show retrieved from the db if it exists
?>
<html>
<body>
  <p><a href="/~e46762/wda/showvotes/session/destroy">Log out</a><p>
  <?php if (isset($template->show)): ?>
    <h2>This is the show page for the show "<?php echo $template->show->name;
?>" and the id "<?php echo $template->show->id; ?>"</h2>
    <ul>
      <li>Name: <?php echo $template->show->name; ?></li>
      <li>Image: <img src="../webroot/images/shows/<?php echo $template->show->image; ?>" /></li>
    </ul>
  <?php else: ?>
    <h2>The show with id "<?php echo $template->id; ?>" does not exist</h2>
  <?php endif; ?>
</body>
</html>
