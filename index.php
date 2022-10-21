<?php
require_once('database/Database.php');
require_once('database/CompanyService.php');

$db = new Database();
$companyService = new CompanyService($db);

?>

<?php require_once("layout/header.php") ?>

<h1>Companies</h1>
<a href="/SpringSystemsFullStackChallenge/add-company.php">Add Company</a>
<table>
  <tr>
    <th>Company Name</th>
    <th>Employee count</th>
    <th>Address</th>
  </tr>
  <?php foreach ($companyService->fetchCompanies() as $company): ?>
    <tr>
      <td><?= $company['company_name'] ?></td>
      <td><?= $company['employee_count'] ?></td>
      <td><?= $company['address'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require_once("layout/footer.php") ?>