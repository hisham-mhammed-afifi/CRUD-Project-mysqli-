<?php

require_once "parts/database.php";

$id = $_POST['id'] ?? null;

/////////// prepare and bind
$stmt = $conn->prepare("DELETE FROM users WHERE id = $id");
$stmt->bind_param("i", $id);

$stmt->execute();
/////// direct user to the home page after submitting
header('Location: index.php');