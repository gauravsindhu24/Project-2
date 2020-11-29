<?php require('connection.php'); ?>
<?php require('partials/header.php'); ?>
<?php require('partials/navbar.php'); ?>
<div class="container">
    <div class="row">
        <h2>Welcome: <?= $_SESSION["f_name"] . " " . $_SESSION["l_name"]; ?></h2>
        <h3>View Questions:</h3>
    </div>           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Questions Name</th>
        <th>Questions Body</th>
        <th>Questions Skills</th>
      </tr>
    </thead>
    <tbody>
    <?php 

    $sql = "SELECT * FROM tbl_questions WHERE get_user_id = " . $_SESSION["user_id"];
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    $tables = $stmt->fetchAll(PDO::FETCH_NUM);
    ?>
    <?php if(isset($tables)): ?>
    <?php foreach($tables as $table): ?>
      <tr>
        <td><?= $table[1]; ?></td>
        <td><?= $table[2]; ?></td>
        <td><?= $table[3]; ?></td>
      </tr>
    <?php endforeach; ?>
    <?php endif;  ?>
    </tbody>
  </table>
</div>
<?php require('partials/footer.php'); ?>