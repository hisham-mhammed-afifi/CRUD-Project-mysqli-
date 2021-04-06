<?php
require_once "parts/database.php";

$search = $_GET['search'] ?? null;

if ($search) {
  $sql = "SELECT * FROM users WHERE firstname LIKE '%$search%' ORDER BY id DESC";
} else {
  $sql = "SELECT * FROM users ORDER BY id DESC";
}


$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result);

?>

<!-- including header HTML -->

<?php include_once "parts/header.php"; ?>
<div class="my-5">
  <h1 class="font-weight-bold text-info">USERS TABLE</h1>
  <a href="create.php" class="btn btn-sm btn-success float-right my-3">
    <i class="fas fa-pencil-alt"></i>
    Create user
  </a>
</div>
<form action="" method="GET">
  <div class="input-group input-group-sm mb-3">
    <input type="text" class="form-control" name="search" value="<?php echo $search ?>">
    <div class="input-group-append">
      <button type="submit" class="btn btn-secondary">Search</button>
    </div>
  </div>
</form>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Image</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) { ?>
      <tr>
        <th scope="row"><?php echo $user[0] ?></th>
        <td><img class="rounded-circle" width="50px" height="50px" src="<?php echo $user[4] ?>" alt=""></td>
        <td>
          <a href="show.php?id=<?php echo $user[0] ?>" class="font-weight-bold text-info">
            <?php echo $user[1] ?>
          </a>
        </td>
        <td><?php echo $user[2] ?></td>
        <td><?php echo $user[3] ?></td>
        <td>
          <a href="update.php?id=<?php echo $user[0] ?>" class="btn btn-sm btn-info">Update</a>
          <form action="delete.php" method="POST" class="d-inline">
            <input type="hidden" name="id" value="<?php echo $user[0] ?>">
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
</div>

</body>

</html>