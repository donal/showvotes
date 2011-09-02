<?php
// available vars:
?>
<html>
<body>
  <h2>This is the index page for all <?php echo strtolower($template->title); ?></h2>
  <ul>
  <?php foreach ($template->users as $user): ?>
    <li>
      <a href="users/<?php echo $user->id; ?>"><?php echo $user->name; ?> (<?php echo $user->username; ?>)</a> |
      <a href="users/<?php echo $user->id; ?>/edit">Edit</a>
    </li>
  <?php endforeach; ?>
  </ul>
</body>
</html>
