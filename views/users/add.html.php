<?php
// available vars:
?>
<html>
<body>
  <h2>Create a User</h2>
  <form method="POST" action="users/create">
    Name: <input type="text" name="name" value="" /><br/>
    Email: <input type="text" name="email" value="" /><br/>
    Username: <input type="text" name="username" value="" /><br/>
    Password: <input type="text" name="password" value="" /><br/>
    <input type="submit" name="create_user" value="Create" />
  </form>
</body>
</html>
