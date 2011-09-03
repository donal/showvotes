<?php
// available vars:
?>
<html>
<body>
  <h2>This is the new page for a session</h2>

  <?php if ($template->error): ?>
  <p style="color:red"><?php echo $template->error; ?></p>
  <?php endif; ?>

  <form method="POST" action="/~e46762/wda/showvotes/session/create">
    Username:
    <input type="text" name="username"/>
    <br/>
    Password:
    <input type="password" name="password"/>
    <br/>
    <input type="submit" name="submit" value="Log in"/>
  </form>
</body>
</html>
