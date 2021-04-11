<?php

  if (isset($_POST['delete'])) {

    $commentId = $_POST['commentId'];

    require_once 'dataStream.php';
    require_once 'metaLinks.php';

    deleteComment($conn, $commentId);

  } else {
    header("location: ../home.php?status=accessDenied");
    exit();
  }
