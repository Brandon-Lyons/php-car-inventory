<?php include("template/header.php"); ?>
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
  <div class="container">
    <form class="form-horizontal" action="add.php" method="post">
      <legend>Add a Vehicle</legend>
      <div class="control-group <?php echo !empty($yearError)?'error':'';?>">
        <label class="control-label">Year</label>
        <div class="controls">
          <input type="text" id="year" name="year" value="<?php echo !empty($year)?$year:'';?>">
          <?php if (!empty($yearError)): ?>
              <span class="help-inline"><?php echo $yearError;?></span>
          <?php endif; ?>
        </div>
      </div>
      <div class="control-group <?php echo !empty($makeError)?'error':'';?>">
        <label class="control-label">Make</label>
        <div class="controls">
          <select id="make" name="make">
            <option></option>
            <option>Acura</option>
            <option>Audi</option>
            <option>BMW</option>
            <option>Buick</option>
            <option>Cadillac</option>
            <option>Chevrolet</option>
            <option>Chrysler</option>
            <option>Dodge</option>
            <option>Eagle</option>
            <option>Ferrari</option>
            <option>Ford</option>
            <option>GMC</option>
            <option>Global Electric Motorcars</option>
            <option>GMC</option>
            <option>Honda</option>
            <option>Hummer</option>
            <option>Hyundai</option>
            <option>Infiniti</option>
            <option>Isuzu</option>
            <option>Jaguar</option>
            <option>Jeep</option>
            <option>Kia</option>
            <option>Lamborghini</option>
            <option>Land Rover</option>
            <option>Lexus</option>
            <option>Lincoln</option>
            <option>Lotus</option>
            <option>Mazda</option>
            <option>Mercedes-Benz</option>
            <option>Mercury</option>
            <option>Mitsubishi</option>
            <option>Nissan</option>
            <option>Oldsmobile</option>
            <option>Peugeot</option>
            <option>Pontiac</option>
            <option>Porsche</option>
            <option>Saab</option>
            <option>Saturn</option>
            <option>Subaru</option>
            <option>Suzuki</option>
            <option>Toyota</option>
            <option>Volkswagen</option>
            <option>Volvo</option>
          </select>
          <?php if (!empty($makeError)): ?>
              <span class="help-inline"><?php echo $makeError;?></span>
          <?php endif; ?>
        </div>
      </div>
      <div class="control-group <?php echo !empty($modelError)?'error':'';?>" >
        <label class="control-label">Model</label>
        <div class="controls">
          <input type="text" id="model" name="model" value="<?php echo !empty($model)?$model:'';?>">
          <?php if (!empty($modelError)): ?>
              <span class="help-inline"><?php echo $modelError;?></span>
          <?php endif; ?>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Extra Information</label>
        <div class="controls">
          <textarea rows="5" id="info" name="info"></textarea>
        </div>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn btn-success">Create</button>
        <a class="btn" href="index.php">Back</a>
      </div>
    </form>
  </div>
</body>
</html>