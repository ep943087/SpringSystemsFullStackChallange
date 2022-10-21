<?php

abstract class AbstractValidationService {

  abstract public function validate(array $formData): array;
  abstract protected function getFields(): array;
  protected function fieldIsEmpty(array $formData, string $field): bool
  {
    return !isset($formData[$field]) || empty($formData[$field]);
  }

  protected function validStrlen(string $field, int $strLen): bool
  {
    return strlen($field) === $strLen;
  }

  public function getDefaultValues(array $formData): array
  {
    $defaultValues = [];

    foreach ($this->getFields() as $field) {
      if (!$this->fieldIsEmpty($formData, $field)) {
        $defaultValues[$field] = $formData[$field];
      } else {
        $defaultValues[$field] = '';
      }
    }

    return $defaultValues;
  }

  public function displayErrors (array $errors): string {
    $html = "<ul>";
    foreach ($errors as $error) {
      $html .= <<<HTML
        <li class="error">{$error}</li>
      HTML;
    }
    $html .= "</ul>";
    return $html;
  }
};