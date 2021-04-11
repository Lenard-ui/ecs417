<?php

if (isset($_POST["sign-up"])) {

  $UName = $_POST["uName"];
  $Email = $_POST["email"];
  $pwd = $_POST["pwd"];
  $pwdrepeat = $_POST["pwdrpt"];

  require_once 'dataStream.php';
  require_once 'metaLinks.php';


  if (emptySignupInput($UName, $Email, $pwd, $pwdrepeat) !== false) {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }

  if (invalidUName($UName) !== false) {
    header("location: ../signup.php?error=invalidName");
    exit();
  }

  if (invalidEmail($Email) !== false) {
    header("location: ../signup.php?error=invalidEmail");
    exit();
  }

  if (pwdConfirm($pwd, $pwdrepeat) !== false) {
    header("location: ../signup.php?error=pwdsDiffer");
    exit();
  }

  if (userExists($conn, $UName, $Email) !== false) {
    header("location: ../signup.php?error=userExists");
    exit();
  }

  if (pwdNotSafe($pwd) !== false) {
    header("location: ../signup.php?error=pwdTooShort");
    exit();
  }

  createUser($conn, $UName, $Email, $pwd);

} else {
  header("location: ../signup.php?error=niceTry");
  exit();
}
