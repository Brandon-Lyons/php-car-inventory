<?php include("template/header.php"); ?>
<?php
  require 'database.php';
  $id = null;
  if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
  }

  if ( null==$id ) {
    header("Location: index.php");
  } else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM vehicles where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
  }
?>
<div class="container">
  <div class="span10 offset1">
    <div class="row">
      <h3><?php echo $data['year'] . " " . $data['make'] . " " . $data['model'] ?></h3>
    </div>
    <div class="row">
      <p><?php echo $data['info'] ?></p>
      <div class="btn-group">
        <a class="btn" href="update.php?id=<?php echo $data['id'] ?>">Edit</a>
        <a class="btn btn-danger" href="delete.php?id=<?php echo $data['id'] ?>">Delete</a>
        <a href="index.php" class="btn">Back</a>
      </div>
    </div>
  </div>
</div> <!-- /container -->
  </body>
</html>