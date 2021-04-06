<?php
require_once "parts/database.php";

$id = $_GET['id'] ?? null;

//////////// get user data himself
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_row($result);

$fnerr = $lnerr = $emerr = '';
$firstname = $user[1];
$lastname = $user[2];
$email = $user[3];
$image = $user[4];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  ///////////// validation
  require_once "parts/validation.php";



  if (!$fnerr && !$lnerr && !$emerr) {
    $image = $_FILES['image'] ?? null;

    if ($image && $image['tmp_name']) {
      if ($user[4]) {
        unlink($user[4]);
      }

      $imagePath = 'images/' . time() . $image['name'];

      mkdir(dirname($imagePath));
      move_uploaded_file($image['tmp_name'], $imagePath);
    }
    /////////// prepare and bind
    $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, image = ? WHERE id = $id");
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $imagePath);
    $stmt->execute();
    /////// direct user to the home page after submitting
    header('Location: index.php');
  }
}

?>
<!-- including header HTML -->

<?php include_once "parts/header.php"; ?>
<div class="my-5">
  <h1 class="font-weight-bold text-info d-inline">CREATE USER</h1>
  <a href="index.php" class="btn btn-sm btn-secondary float-right my-3 mb-5">
    <i class="fas fa-undo-alt"></i>
    Go back
  </a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
  <img width="200px" height="200px" src="<?php echo $user[4] ?>" alt="">
  <div class="form-group">
    <label class="d-block">Profile image</label>
    <input type="file" name="image">
  </div>
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control" name="firstname" value="<?php echo $firstname ?>">
    <span class="text-danger"><?php echo $fnerr ?></span>
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control" name="lastname" value="<?php echo $lastname ?>">
    <span class="text-danger"><?php echo $lnerr ?></span>
  </div>
  <div class="form-group">
    <label>Email address</label>
    <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
    <span class="text-danger"><?php echo $emerr ?></span>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>

</html>