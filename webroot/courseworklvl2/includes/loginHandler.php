<?php

if (isset($_POST["submit"])) {

  $login = $_POST["login"];
  $pwd = $_POST["password"];

  require_once 'dataStream.php';
  require_once 'metaLinks.php';

  if (emptyLoginInput($login, $pwd) !== false) {
    header("location: ../home.php?status=emptyInput");
    exit();
  }

  loginUser($conn, $login, $pwd);

} else {
  header("location: ../home.php?status=bruh");
  exit();
}
