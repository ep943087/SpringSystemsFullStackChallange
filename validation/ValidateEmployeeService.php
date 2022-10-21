<?php

require_once("AbstractValidationService.php");

class ValidateEmployeeService extends AbstractValidationService
{
  public function validate(array $formData): array
  {
    $errors = [];
    if ($this->fieldIsEmpty($formData, 'employee_name')) {
      $errors[] = 'Employee name is required';
    }

    if ($this->fieldIsEmpty($formData, 'company_id')) {
      $errors[] = 'Company is required';
    } else if (!preg_match('/^[0-9]{1,11}$/', $formData['company_id'])) {
      $errors[] = 'Company is invalid';
    }

    return $errors;
  }

  public function getFields(): array {
    return ['employee_name', 'company_id'];
  }
}