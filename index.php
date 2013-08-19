<?php include("template/header.php"); ?>
  <div class="container">
    <div class="row">
      <h2>Vehicle Inventory</h2>
    </div>
    <div class="row">
      <a href="add.php" class="btn" id="add-vehicle">Add</a>
      <table class="table table-condensed table-hover" id="vehicle-list">
        <?php
          include 'database.php';
          $pdo = Database::connect();
          $sql = 'SELECT * FROM vehicles ORDER BY id DESC';
          foreach ($pdo->query($sql) as $row) {
            echo '<tr>';
            echo '<td width=45><a class="btn" href="read.php?id='.$row['id'].'">Select</a></td>';
            echo '<td id="entry">';
            echo $row['year'] . ' ';
            echo $row['make'] . ' ';
            echo $row['model'];
            echo '</td>';
            echo '<td width=150>';
            echo '<a class="btn" href="update.php?id='.$row['id'].'">Edit</a>';
            echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
            echo '</td>';
            echo '</tr>';
          }
          Database::disconnect();
        ?>
      </table>
    </div>
  </div>
</body>
</html>