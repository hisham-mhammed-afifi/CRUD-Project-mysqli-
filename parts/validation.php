<?php

if (empty($_POST['firstname'])) {
  $fnerr = "First name is required";
} else {
  $firstname = $_POST['firstname'];
}

if (empty($_POST['lastname'])) {
  $lnerr = "Last name is required";
} else {
  $lastname = $_POST['lastname'];
}

if (empty($_POST['email'])) {
  $emerr = "Email is required";
} else {
  $email = $_POST['email'];
}