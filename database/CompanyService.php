<?php

require_once("Database.php");

class CompanyService {

  private Database $db;

  public function __construct(Database $db)
  {
    $this->db = $db;
  }

  public function fetchCompanies() {
    $query = <<<SQL
      SELECT
        company.company_id,
        company.street,
        company.city,
        company.state,
        company.zipcode,
        CONCAT(street, ', ', city, ', ', state, ', ', zipcode) as address,
        company.company_name, 
        COUNT(employee.employee_id) as employee_count
      FROM company
      LEFT JOIN employee
        ON employee.company_id = company.company_id
      GROUP BY company.company_id;
    SQL;
    return $this->db->fetchManyAndClean($query);
  }

  public function insertCompany(string $companyName, string $street, string $state, string $city, string $zipcode) {
    $query = <<<SQL
      INSERT INTO Company (company_name, street, city, state, zipcode)
      VALUES (?, ?, ?, ?, ?);
    SQL;

    $params = [$companyName, $street, $city, $state, $zipcode];
    $types = "sssss";

    $this->db->executeQuery($query, $types, $params);
  }
};