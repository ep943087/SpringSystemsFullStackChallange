CREATE TABLE Company (
  company_id INT NOT NULL AUTO_INCREMENT,
  company_name VARCHAR(255) NOT NULL,
  street VARCHAR(255) NOT NULL,
  city VARCHAR(255) NOT NULL,
  state CHAR(2) NOT NULL,
  zipcode CHAR(5) NOT NULL,
  PRIMARY KEY (company_id)
);