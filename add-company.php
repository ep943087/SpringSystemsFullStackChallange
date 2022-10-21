<?php

require_once("database/Database.php");
require_once("database/CompanyService.php");
require_once("validation/ValidateCompanyService.php");

$validateCompanyService = new ValidateCompanyService();

?>

<?php require_once("layout/header.php") ?>

<?php
$errors = [];

if (isset($_POST["submit"])) {
  $errors = $validateCompanyService->validate($_POST);

  if (empty($errors)) {
    $db = new Database();
    $companyService = new CompanyService($db);

    $companyService->insertCompany(
      $_POST['company_name'],
      $_POST['street'],
      $_POST['state'],
      $_POST['city'],
      $_POST['zipcode']
    );

    header("Location: /SpringSystemsFullStackChallenge");
  }
}

$defaultValues = $validateCompanyService->getDefaultValues($_POST);

?>

<h1>Add Company</h1>

<?= $validateCompanyService->displayErrors($errors) ?>

<form method="POST">
  <div>
    <label for="company_name">Company Name</label>
    <input value="<?= $defaultValues['company_name'] ?>" type="text" name="company_name" />
  </div>
  <div>
    <label for="street">Street</label>
    <input value="<?= $defaultValues['street'] ?>" type="text" name="street" />
  </div>
  <div>
    <label for="state">State</label>
    <input value="<?= $defaultValues['state'] ?>" type="text" name="state" />
  </div>
  <div>
    <label for="city">City</label>
    <input value="<?= $defaultValues['city'] ?>" type="text" name="city" />
  </div>
  <div>
    <label for="zipcode">Zipcode</label>
    <input value="<?= $defaultValues['zipcode'] ?>" type="text" name="zipcode" />
  </div>

  <input type="submit" name="submit">
</form>

<?php require_once("layout/footer.php") ?>