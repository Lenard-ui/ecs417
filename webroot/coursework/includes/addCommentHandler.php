<?php

  if (isset($_POST['submit-comment'])) {

    session_start();

    $comentAuthor = $_SESSION["userUname"];
    $commentBody = $_POST['comment-body'];
    $blogId = $_POST['blog-number'];

    require_once 'dataStream.php';
    require_once 'metaLinks.php';

    if (emptyCommentinput($commentBody, $blogId) !== false) {
      header("location: ../comments.php?error=emptyInput");
      exit();
    }

    createComment($conn, $comentAuthor, $commentBody, $blogId);

  } else {
    header("location: ../home.php?status=accessDenied");
    exit();
  }
