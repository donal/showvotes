<?php
// available vars:
// $template->user user data
// $template->errors if user validation fails
?>
<html>
<body>
  <h2>Update a User</h2>
  <form method="POST" action="update">
    <table>
    <tr>
      <td>Name:</td>
      <td><input type="text" name="name" value="<?php echo $template->user->name; ?>" /></td>
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
      <td><input type="text" name="email" value="<?php echo $template->user->email; ?>" /></td>
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
      <td><input type="text" name="username" value="<?php echo $template->user->username; ?>" /></td>
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
      <td><input type="text" name="password" value="<?php echo $template->user->password; ?>" /></td>
      <td>
        <?php
          if (isset($template->errors['password'])) {
            echo $template->errors['password'];
          }
        ?>
      </td>
    </tr>
    <tr>
      <td><input type="submit" name="update_user" value="Update" /></td>
      <td></td>
      <td></td>
    </tr>
    </table>
  </form>
</body>
</html>
