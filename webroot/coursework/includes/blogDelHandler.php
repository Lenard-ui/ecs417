<?php

  if (isset($_POST['delete'])) {

    $blogId = $_POST['blogId'];

    require_once 'dataStream.php';
    require_once 'metaLinks.php';

    deleteBlogPost($conn, $blogId);

  } else {
    header("location: ../home.php?status=accessDenied");
    exit();
  }
