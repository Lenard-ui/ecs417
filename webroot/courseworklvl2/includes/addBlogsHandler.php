<?php

  require_once 'dataStream.php';
  require_once 'metaLinks.php';

  if (isset($_POST['submit-blog'])) {

    $blogTitle = $_POST['blog-title'];
    $blogBody = $_POST['blog-body'];

    if ($inputErr = emptyBloginput($blogTitle, $blogBody) !== false) {
      if ($inputErr === true) {
        header("location: ../blogs.php?error=emptyTitleTextInput");
        exit();
      } else {
        header("location: ../blogs.php?error=emptyInput");
        exit();
      }
    }

    createBlogPost($conn, $blogTitle, $blogBody);

  } elseif (isset($_POST['preview-blog'])) {
    $query = array(
    'preview' => "on",
    'blog-title' => $_POST['blog-title'],
    'blog-body' => $_POST['blog-body']
    );

    $query = http_build_query($query);
    header("Location: ../blogs.php?$query");
    exit();
  } elseif (isset($_POST['end-preview'])) {
    $query = array(
    'preview' => "off",
    'blog-title' => $_POST['blog-title'],
    'blog-body' => $_POST['blog-body']
    );

    $query = http_build_query($query);
    header("Location: ../blogs.php?$query");
    exit();
  } else {
    header("location: ../home.php?status=accessDenied");
    exit();
  }
