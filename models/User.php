<?php

require_once(LIBRARY_PATH . DS . 'Database.php');

/**
 * This is the User class.
 *
 * @author donal.ellis@rmit.edu.au
 */
class User {

  /**
   * A method for retrieving users from the users table.
   *
   * @param array $data An optional array of key:value pairs to be used as
   *                    parameters in the SQL query.
   * @return array An array of database Objects where each Object represents a
   *               user.
   */
  public static function retrieve(array $data = array()) {

    $sql = 'SELECT * FROM users';
    $values = array();
    if (count($data)) {
      $count = 0;
      foreach ($data as $key => $value) {
        if ((++$count) == 1) {
          $sql .= " WHERE {$key} = ?";
          $values[] = $value;
        } else {
          $sql .= " AND {$key} = ?";
          $values[] = $value;
        }
      }
    }

    try {
      $database = Database::getInstance();
    
      $statement = $database->pdo->prepare($sql);

      $statement->execute($values);
      // result is FALSE if no rows found
      $result = $statement->fetch(PDO::FETCH_OBJ);
    
      $database->pdo = null;
    } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
    }
    if ($result) {
      return $result;
    } else {
      return NULL;
    }
  }

  public static function create(array $data) {

  }

  /**
   * An example private method to show the @access tag for PhpDocumentor.
   *
   * @access private 
   */
  private static function example() {

  }

}
