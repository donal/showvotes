<?php

require_once(LIBRARY_PATH . DS . 'Database.php');

class User {

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

}
