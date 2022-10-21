<?php

require_once('constants.php');

class Database {
  private $connection = null;

  public function __construct()
  {
    $this->connection = mysqli_connect(DB_LOCATION, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if ($error = mysqli_connect_error()) {
      die("Database connection error: " . $error);
    }
  }

  public function executeQuery(string $query, string $types = "", array $params = [])
  {

    if (empty($params)) {
      $result = mysqli_query($this->connection, $query);
      if (!$result) {
        die("Execution failed: " . mysqli_error($this->connection));
      }
      return mysqli_query($this->connection, $query);
    }

    $stmt = mysqli_prepare($this->connection, $query);
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    $execute = mysqli_stmt_execute($stmt);
    if (!$execute) {
      die("Execution failed: " . mysqli_error($this->connection));
    }
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $result;
  }

  public function fetchMany(string $query, string $types = "", array $params = []): array {
    $result = $this->executeQuery($query, $types, $params);
    $records = [];

    while ($row = mysqli_fetch_assoc($result)) {
      $records[] = $row;
    }

    return $records;
  }

  public function fetchManyAndClean(string $query, string $types = "", array $params = []): array
  {
    $records = $this->fetchMany($query, $types, $params);
    
    foreach ($records as $index => $value) {
      foreach ($value as $key => $val) {
        $records[$index][$key] = htmlspecialchars($val);
      }
    }
    return $records;
  }
};