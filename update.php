<?php include("template/header.php"); ?>
<?php
  require 'database.php';
  $id = null;
  if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
  }
  if ( null==$id ) {
    header("Location: index.php");
  }
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

    // update data
    if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE vehicles  set year = ?, make = ?, model =?, info =? WHERE id = ?";
      $q = $pdo->prepare($sql);
      $q->execute(array($year,$make,$model,$info,$id));
      Database::disconnect();
      header("Location: index.php");
    }
  } else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM vehicles where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $year = $data['year'];
    $make = $data['make'];
    $model = $data['model'];
    $info = $data['info'];
    Database::disconnect();
  }
?>
<div class="container">
  <div class="span10 offset1">
    <div class="row">
      <h3>Update Vehicle Information</h3>
    </div>
    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
      <div class="control-group <?php echo !empty($yearError)?'error':'';?>">
        <label class="control-label">Year</label>
        <div class="controls">
            <input name="year" type="text" value="<?php echo !empty($year)?$year:'';?>">
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
      <div class="control-group <?php echo !empty($modelError)?'error':'';?>">
        <label class="control-label">Model</label>
        <div class="controls">
        <input name="model" type="text" value="<?php echo !empty($model)?$model:'';?>">
        <?php if (!empty($modelError)): ?>
          <span class="help-inline"><?php echo $modelError;?></span>
        <?php endif;?>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Extra Information</label>
        <div class="controls">
          <textarea rows="5" id="info" name="info"></textarea>
        </div>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn btn-success">Update</button>
        <a class="btn" href="index.php">Back</a>
      </div>
    </form>
  </div>
</div> <!-- /container -->
</body>
</html>
