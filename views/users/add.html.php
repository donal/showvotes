<?php
// available vars:
// $template->errors if user validation fails
?>
<html>
<body>
  <h2>Create a User</h2>
  <form method="POST" action="create">
    <table>
    <tr>
      <td>Name:</td>
      <td><input type="text" name="name" value="<?php echo $template->user['name']; ?>" /></td>
      <td>
        <?php
          if (isset($template->errors['name'])) {
            echo $template->errors['name'];
          }
        ?>
      </td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><input type="text" name="email" value="<?php echo $template->user['email']; ?>" /></td>
      <td>
        <?php
          if (isset($template->errors['email'])) {
            echo $template->errors['email'];
          }
        ?>
      </td>
    </tr>
    <tr>
      <td>Username:</td>
      <td><input type="text" name="username" value="<?php echo $template->user['username']; ?>" /></td>
      <td>
        <?php
          if (isset($template->errors['username'])) {
            echo $template->errors['username'];
          }
        ?>
      </td>
    </tr>
    <tr>
      <td>Password:</td>
      <td><input type="text" name="password" value="<?php echo $template->user['password']; ?>" /></td>
      <td>
        <?php
          if (isset($template->errors['password'])) {
            echo $template->errors['password'];
          }
        ?>
      </td>
    </tr>
    <tr>
      <td><input type="submit" name="create_user" value="Create" /></td>
      <td></td>
      <td></td>
    </tr>
    </table>
  </form>
</body>
</html>
