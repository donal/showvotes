<?php

require_once(LIBRARY_PATH . DS . 'Database.php');

/**
 * This is the Show class.
 *
 * @author donal.ellis@rmit.edu.au
 */
class Show {

  /**
   * If validation fails, errors are written to this variable.
   */
  private static $errors;

  /**
   * A method for validating the data
   *
   * @param $data An array of POSTed data.
   * @return bool Whether the data is valid or not.
   */
  public static function validates(array &$data) {
    $errors = array();

    // error checks from specific to general
    if (!isset($data['name']) || empty($data['name'])) {
      $errors['name'] = 'You must provide the show name';
    }
    // only unset the name data after checking for all errors
    if (isset($errors['name'])) {
      unset($data['name']);
    }

    // handle image upload
    if ($data['image']['type'] != 'image/png' && $data['image']['type'] != 'image/jpeg') {
      $errors['image'] = "Your image must be a png or jpg file";
    }
    if ($data['image']['size'] > 200000) {
      $errors['image'] = "Your image must be smaller than 100kb";
    }
    if ($data['image']['error']) {
      $errors['image'] = "There is a problem with your image file";
    }

    self::$errors = $errors;
    if (count($errors)) {
      return false;
    }
    return true;
  }

  /**
   * Returns any validation errors.
   *
   * @return array An array of errors, or an empty array.
   */
  public static function errors() {
    return self::$errors;
  }

  /**
   * A method for retrieving shows from the shows table.
   *
   * @param array $data An optional array of key:value pairs to be used as
   *                    parameters in the SQL query.
   * @return array An array of database Objects where each Object represents a
   *               show.
   */
  public static function retrieve(array $data = array()) {

    $sql = 'SELECT * FROM shows';
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
      $result = $statement->fetchAll(PDO::FETCH_OBJ);
    
      $database->pdo = null;
    } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
    }
    if (count($result) > 1) {
      return $result;
    } else if (count($result) == 1) {
      return $result[0];
    } else {
      return NULL;
    }
  }

  /**
   * Writes a new row to the shows table based on given data.
   *
   * @param array $data The POSTed data.
   * @return int Returns id of the inserted row (or throws an Exception)
   */
  public static function create(array $data) {
    // TODO could do a check here to ensure data exists

    // assumes all new shows will not be admin
    $sql  = 'INSERT INTO shows (name, image, hashtag) VALUES (?, ?, ?)';
    $values = array(
      $data['name'],
      $data['image'],
      $data['hashtag'],
    );

    try {
      $database = Database::getInstance();
    
      $statement = $database->pdo->prepare($sql);
      $return = $statement->execute($values);
   
      if ($return) {
        $id = $database->pdo->lastInsertId();
      }
      $database->pdo = null;
    } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
    }
    if ($return) {
      return $id;
    }
    return false;
  }

  /**
   * Updates an existing row in the shows table based on given data.
   *
   * @param int $id The row id of the show to update.
   * @param array $data The POSTed data.
   * @return int bool Whether update was successful or not.
   */
  public static function update($id, array $data) {
    // TODO could do a check here to ensure data exists

    // assumes all new shows will not be admin
    $sql  = 'UPDATE shows SET name = ?, image = ?, hashtag = ? WHERE id = ?';
    $values = array(
      $data['name'],
      $data['image'],
      $data['hashtag'],
      $id
    );

    try {
      $database = Database::getInstance();
    
      $statement = $database->pdo->prepare($sql);
      $return = $statement->execute($values);
   
      $database->pdo = null;
    } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
    }
    return $return;
  }

}
