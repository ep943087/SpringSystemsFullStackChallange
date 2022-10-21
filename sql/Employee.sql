CREATE TABLE Employee (
  employee_id INT NOT NULL AUTO_INCREMENT,
  employee_name VARCHAR(255) NOT NULL,
  company_id INT NOT NULL,
  PRIMARY KEY (employee_id),
  FOREIGN KEY (company_id)
    REFERENCES Company (company_id)
);