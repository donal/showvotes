<?php
// available vars:
?>
<html>
<body>
  <h2>This is the index page for all <?php echo strtolower($template->title); ?></h2>
  <ul>
  <?php foreach ($template->shows as $show): ?>
    <li>
      <a href="shows/<?php echo $show->id; ?>"><?php echo $show->name; ?> (<?php echo $show->hashtag; ?>)</a> | 
      <a href="shows/<?php echo $show->id; ?>/tweets">Tweets</a> |
      <a href="shows/<?php echo $show->id; ?>/edit">Edit</a>
    </li>
  <?php endforeach; ?>
  </ul>
</body>
</html>
