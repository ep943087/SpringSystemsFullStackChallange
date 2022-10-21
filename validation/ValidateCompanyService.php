<?php

require_once("AbstractValidationService.php");

class ValidateCompanyService extends AbstractValidationService {

  protected function getFields(): array
  {
    return ['company_name', 'street', 'state', 'city', 'zipcode'];
  }

  public function validate(array $formData): array
  {
    $errors = [];
    if ($this->fieldIsEmpty($formData, 'company_name')) {
      $errors[] = 'Company name is required';
    }

    if ($this->fieldIsEmpty($formData, 'street')) {
      $errors[] = 'Street is required';
    }

    if ($this->fieldIsEmpty($formData, 'state')) {
      $errors[] = 'State is required';
    } else if (!preg_match('/^[A-Za-z]{2}$/', $formData['state'])) {
      $errors[] = 'State must be 2 characters long';
    }

    if ($this->fieldIsEmpty($formData, 'city')) {
      $errors[] = 'City is required';
    }

    if ($this->fieldIsEmpty($formData, 'zipcode')) {
      $errors[] = 'Zip Code is required';
    } else if (!preg_match('/^[0-9]{5}$/', $formData['zipcode'])) {
      $errors[] = 'Zip Code must be 5 digits long';
    }

    return $errors;
  }
}