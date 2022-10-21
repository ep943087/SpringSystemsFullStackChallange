<?php

require_once("Database.php");

class EmployeeService {

  private Database $db;

  public function __construct(Database $db)
  {
    $this->db = $db;
  }

  public function fetchEmployees(): array
  {
    $query = <<<SQL
      SELECT employee_id, employee_name, company_name
      FROM employee AS e
      INNER JOIN company AS c
        ON e.company_id = c.company_id
    SQL;
    return $this->db->fetchManyAndClean($query);
  }

  public function insertEmployee(string $employee_name, int $company_id)
  {
    $query = <<<SQL
      INSERT INTO employee (employee_name, company_id)
      VALUES (?, ?);
    SQL;

    $params = [$employee_name, $company_id];
    $types = "si";

    $this->db->executeQuery($query, $types, $params);
  }
}