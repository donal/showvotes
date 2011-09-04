<?php
// available vars:
// $id - id as passed in through the URL
// $show - show retrieved from the db if it exists
// $tweets - most recent tweets with the show's hashtag
?>
<html>
<head>
<script src="/~e46762/wda/showvotes/webroot/js/jquery.js"></script>
<script src="/~e46762/wda/showvotes/webroot/js/site.js"></script>
<script type="text/javascript">
  show = {
    hashtag: "<?php echo $template->show->hashtag; ?>"
  };
</script>
</head>
<body>
  <p><a href="/~e46762/wda/showvotes/session/destroy">Log out</a><p>
  <?php if (isset($template->show)): ?>
    <h2>This is the tweets page for the show "<?php echo $template->show->name; ?>"</h2>
    <ul>
      <li>Name: <?php echo $template->show->name; ?></li>
    </ul>
    <a href="#" class="showtweets">Tweets for <?php echo $template->show->hashtag; ?></a>:<br/>
    <div id="tweets">

    </div>
  <?php else: ?>
    <h2>The show with id "<?php echo $template->id; ?>" does not exist</h2>
  <?php endif; ?>
</body>
</html>
