<?php
// available vars:
// $id - id as passed in through the URL
// $show - show retrieved from the db if it exists
// $tweets - most recent tweets with the show's hashtag
?>
<html>
<body>
  <p><a href="/~e46762/wda/showvotes/session/destroy">Log out</a><p>
  <?php if (isset($template->show)): ?>
    <h2>This is the tweets page for the show "<?php echo $template->show->name; ?>"</h2>
    <ul>
      <li>Name: <?php echo $template->show->name; ?></li>
    </ul>
    Tweets for <?php echo $template->show->hashtag; ?>:<br/>
    <ul>
      <?php foreach ($template->tweets as $tweet): ?>
      <li><?php echo $tweet; ?></li>
      <?php endforeach; ?> 
    </ul>
    <ul>
  <?php else: ?>
    <h2>The show with id "<?php echo $template->id; ?>" does not exist</h2>
  <?php endif; ?>
</body>
</html>
