<?php

require_once("database/Database.php");
require_once("database/EmployeeService.php");
require_once("database/CompanyService.php");

$db = new Database();
$employeeService = new EmployeeService($db);
$companyService = new CompanyService($db);

$showAddEmployeePage = !empty($companyService->fetchCompanies());

?>

<?php require_once("layout/header.php") ?>

<h1>Employees</h1>

<?php if ($showAddEmployeePage): ?>
  <a href="/SpringSystemsFullStackChallenge/add-employee.php">Add Employee</a>
<?php endif; ?>

<table>
  <tr>
    <th>Employee Name</th>
    <th>Company</th>
  </tr>
  <?php foreach ($employeeService->fetchEmployees() as $employee): ?>
    <tr>
      <td><?= $employee['employee_name'] ?></td>
      <td><?= $employee['company_name'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require_once("layout/footer.php") ?>