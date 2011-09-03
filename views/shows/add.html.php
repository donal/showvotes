<?php
// available vars:
// $template->errors if show validation fails
?>
<html>
<body>
  <h2>Create a Show</h2>
  <form method="POST" action="create" enctype="multipart/form-data">
    <table>
    <tr>
      <td>Name:</td>
      <td><input type="text" name="name" value="<?php echo $template->show['name']; ?>" /></td>
      <td>
        <?php
          if (isset($template->errors['name'])) {
            echo $template->errors['name'];
          }
        ?>
      </td>
    </tr>
    <tr>
      <td>Hash Tag:</td>
      <td><input type="text" name="hashtag" value="<?php echo $template->show['hashtag']; ?>" /></td>
      <td>
        <?php
          if (isset($template->errors['hashtag'])) {
            echo $template->errors['hashtag'];
          }
        ?>
      </td>
    </tr>
    <tr>
      <td>Image:</td>
      <td><input type="file" name="image" /></td>
      <td>
        <?php
          if (isset($template->errors['image'])) {
            echo $template->errors['image'];
          }
        ?>
      </td>
    </tr>
    <tr>
      <td><input type="submit" name="create_show" value="Create" /></td>
      <td></td>
      <td></td>
    </tr>
    </table>
  </form>
</body>
</html>
