<?php

  require 'database.php';

  if ( !empty($_POST)) {
    // keep track validation errors
    $yearError = null;
    $makeError = null;
    $modelError = null;

    // keep track post values
    $year = $_POST['year'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $info = $_POST['info'];

    // validate input
    $valid = true;
    if (empty($year)) {
      $yearError = 'Please enter Year';
      $valid = false;
    }

    if (empty($make)) {
      $makeError = 'Please select Make';
      $valid = false;
    }

    if (empty($model)) {
      $modelError = 'Please enter Model';
      $valid = false;
    }

    // insert data
    if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO vehicles (year,make,model,info) values(?, ?, ?, ?)";
      $q = $pdo->prepare($sql);
      $q->execute(array($year,$make,$model,$info));
      Database::disconnect();
      header("Location: index.php");
    }
  }
?>