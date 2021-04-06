<?php
require_once "parts/database.php";

$id = $_GET['id'] ?? null;

$firstname = $user['firstname'] ?? null;
$lastname = $user['lastname'] ?? null;
$email = $user['email'] ?? null;



//////////// get user data himself
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);


?>
<!-- including header HTML -->

<?php include_once "parts/header.php"; ?>
<div class="my-5">
  <h1 class="font-weight-bold text-info d-inline">
    <?php echo $user['firstname'] . ' ' . $user['lastname'] ?>
  </h1>
  <a href="index.php" class="btn btn-sm btn-secondary float-right my-3 mb-5">
    <i class="fas fa-undo-alt"></i>
    Go back
  </a>
</div>

<ul class="list-group">
  <li class="list-group-item">
    <img width="200px" height="200px" src="<?php echo $user['image'] ?>" alt="">
  </li>
  <li class="list-group-item">
    <p class="font-weight-bold">Firstname</p>
    <p><?php echo $user['firstname'] ?></p>
  </li>
  <li class="list-group-item">
    <p class="font-weight-bold">Firstname</p>
    <p><?php echo $user['lastname'] ?></p>
  </li>
  <li class="list-group-item">
    <p class="font-weight-bold">Firstname</p>
    <p><?php echo $user['email'] ?></p>
  </li>
</ul>
</div>

</body>

</html>