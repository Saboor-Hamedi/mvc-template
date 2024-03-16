<?php

namespace fastmvc\validate;

class Validation
{

  private $errors = [];

  public function string($input, $validation_rules)
  {
    foreach ($validation_rules as $rule) {
      $rule_name = $rule[0];
      $rule_message = $rule[1];
      switch ($rule_name) {
        case 'required':
          if (empty($input)) {
            return $rule_message;
          }
          break;
        case 'min':
          $min_length = $rule[2];
          if (strlen($input) < $min_length) {
            return $rule_message;
          }
          break;
        case 'max': // New mixed rule
          $max_length = $rule[2];
          if (strlen($input) > $max_length) {
            return $rule_message;
          }
          break;
        case 'no_numbers':
          if (preg_match('/[0-9]/', $input)) {
            return $rule_message;
          }
          break;
        case 'no_space':
          if (preg_match('/\s/', $input)) {
            return $rule_message;
          }
          break;
      }
    }

    return null; // No errors
  }

  public function numbers($input, $validation_rules)
  {
    foreach ($validation_rules as $rule) {
      $rule_name = $rule[0];
      $rule_message = $rule[1];
      switch ($rule_name) {
        case 'required':
          if (empty($input)) {
            return $rule_message;
          }
          break;
        case 'integer':
          if (!is_numeric($input)) {
            return $rule_message;
          }
          break;
        case 'positive':
          if ($input <= 0) {
            return $rule_message;
          }
          break;
      }
    }

    return null; // No errors
  }

  public function email($input, $validation_rules)
  {
    $errors = [];

    foreach ($validation_rules as $rule) {
      $rule_name = $rule[0];
      $rule_message = $rule[1];

      switch ($rule_name) {
        case 'required':
          if (empty($input)) {
            $errors[] = $rule_message;
            return $errors; // Stop processing further rules for this field
          }
          break;
        case 'email':
          $emailParts = explode('@', $input);
          if (count($emailParts) < 2 || !filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $errors[] = $rule_message;
            return $errors; // Stop processing further rules for this field
          }
          break;

          // Add more rules as needed
      }
    }

    return $errors;
  }
  public function password($input, $validation_rules)
  {
    $errors = [];

    foreach ($validation_rules as $rule) {
      $rule_name = $rule[0];
      $rule_message = $rule[1];

      switch ($rule_name) {
        case 'required':
          if (empty($input)) {
            $errors[] = $rule_message;
          }
          break;
        case 'min':
          $min_length = $rule[2];
          if (strlen($input) < $min_length) {
            $errors[] = $rule_message;
          }
          break;
          // Add more password rules as needed
      }
    }

    return $errors;
  }
  public function onlySelectOption($option)
  {

    if ($option === '') {
      return 'Option is required';
    }
    return null; // No validation errors
  }

  public function getErrors()
  {
    return $this->errors;
  }
}
