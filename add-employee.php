<?php

require_once("database/Database.php");
require_once("database/CompanyService.php");
require_once("database/EmployeeService.php");
require_once("validation/ValidateEmployeeService.php");

$db = new Database();
$companyService = new CompanyService($db);
$employeeService = new EmployeeService($db);
$employeeValidationService = new ValidateEmployeeService();

$companies = $companyService->fetchCompanies();
$errors = [];

if (isset($_POST['submit'])) {
  $errors = $employeeValidationService->validate($_POST);

  if (empty($errors)) {
    $employeeService->insertEmployee($_POST['employee_name'], $_POST['company_id']);
    header("Location: /SpringSystemsFullStackChallenge/employees.php");
    exit();
  }
}

$defaultValues = $employeeValidationService->getDefaultValues($_POST);

?>

<?php require_once("layout/header.php") ?>
<h1>Add Employee</h1>
<?= $employeeValidationService->displayErrors($errors) ?>
<form method="POST">

  <div>
    <label label="employee_name">Employee Name</label>
    <input value="<?= $defaultValues['employee_name'] ?>" type="text" name="employee_name" />
  </div>

  <div>
    <label label="">Company</label>
    <select name="company_id">
      <?php foreach ($companies as $company): ?>
        <option value="<?= $company["company_id"] ?>" <?= $company['company_id'] == $defaultValues['company_id'] ? 'selected' : '' ?> >
          <?= $company["company_name"] ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <input type="submit" name="submit" />
</form>

<?php require_once("layout/footer.php") ?>