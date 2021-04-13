<?php
require_once 'dataStream.php';
function setHeader(){
  return '<!DOCTYPE html>
        <html lang="en">

          <head id="head">
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="reset.css" type="text/css">
            <link rel="stylesheet" href="default_style.css" type="text/css">'
            .setColorMode(getColorMode())
            .setTitle().
          '</head>';
}

function getColorMode(){
  if (isset($_COOKIE['colorMode'])) {
    return $_COOKIE['colorMode'];
  } else {
    return "light";
  }
}

function setColorMode($cMode){
  if ($cMode == "dark") {
    return '<link rel="stylesheet" href="dark_style.css" type="text/css" id="pageColor">';
  } elseif ($cMode == "light") {
    return '<link rel="stylesheet" href="light_style.css" type="text/css" id="pageColor">';
  }

}

function setTitle() {
  $title = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

  switch ($title) {
    case 'home.php':
      return "<title>KLI - Home</title>";
      break;

    case 'signup.php':
      return "<title>KLI - Sign Up</title>";
      break;

    case 'blogs.php':
      return "<title>KLI - Blog Editor</title>";
      break;

    case 'viewBlogs.php':
      return "<title>KLI - Blogs</title>";
      break;

    case 'comments.php':
      return "<title>KLI - Blog Editor</title>";
      break;

    default:
      return "<title>KLI - Page</title>";
      break;
  }
}

function setJSFooter() {
  $title = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

  switch ($title) {
    case 'home.php':
      return "<script src='home.js'></script>";
      break;

    case 'signup.php':
      return "<script src='signup.js'></script>";
      break;

    case 'blogs.php':
      return "<script src='blogs.js'></script>";
      break;

    case 'viewBlogs.php':
      return "<script src='viewBlogs.js'></script>";
      break;

    default:
      return "";
      break;
  }
}

function setColorButton($cMode){
  if ($cMode == "dark") {
    return '<input type="checkbox" id="LD-switch" checked>';
  } else {
    return '<input type="checkbox" id="LD-switch" unchecked>';
  }
}

function emptySignupInput($UName, $Email, $pwd, $pwdrepeat) {
  $ans;
  if(empty($UName) || empty($Email) || empty($pwd) || empty($pwdrepeat)) {
    $ans = true;
  } else {
    $ans = false;
  }
  return $ans;
}

function invalidUName($UName) {
  $ans;
  if(!preg_match("/^[a-zA-Z0-9]*$/", $UName)) {
    $ans = true;
  } else {
    $ans = false;
  }
  return $ans;
}

function invalidEmail($Email) {
  $ans;
  if(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    $ans = true;
  } else {
    $ans = false;
  }
  return $ans;
}

function pwdConfirm($pwd, $pwdrepeat) {
  $ans;
  if($pwd !== $pwdrepeat) {
    $ans = true;
  } else {
    $ans = false;
  }
  return $ans;
}

function userExists($conn, $UName, $Email) {
  $sql = "SELECT * FROM users WHERE usersUname = ? OR usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $UName, $Email);
  mysqli_stmt_execute($stmt);

  $outputData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($outputData)) {
    return $row;
  } else {
    return false;
  }
  mysqli_stmt_close($stmt);

}

function pwdNotSafe($pwd) {
  $ans;
  if(strlen($pwd)<7) {
    $ans = true;
  } else {
    $ans = false;
  }
  return $ans;
}

function createUser($conn, $UName, $Email, $pwd) {
  $sql = "INSERT INTO users (usersUname, usersEmail, usersPwd) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtFailed");
    exit();
  }

  $pwdCypher = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "sss", $UName, $Email, $pwdCypher);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../home.php?status=accMade");
  exit();
}

function catchSignupError(){
  if (isset($_GET["error"])) {

    echo '<aside class="right-side">
            <div class="error box">
              <h2>ATTENTION</h2>';

    if ($_GET["error"] == "emptyinput") {
      echo "<p>Please fill in all fields!</p>";
    } else if ($_GET["error"] == "invalidName") {
      echo "<p>Name invalid! use only letters and numbers</p>";
    } else if ($_GET["error"] == "invalidEmail") {
      echo "<p>Whatever you entered isn't an Email!</p>";
    } else if ($_GET["error"] == "pwdsDiffer") {
      echo "<p>Your passwords don't match!</p>";
    } else if ($_GET["error"] == "userExists") {
      echo "<p>This user allready exists!</p>";
    } else if ($_GET["error"] == "pwdTooShort") {
      echo "<p>Your password is insecure make it 8 characters or more!</p>";
    } else if ($_GET["error"] == "niceTry") {
      echo "<p>I made this UI for navigation...<br>Why not use it?</p>";
    } else if ($_GET["error"] == "stmtFailed") {
      echo "<p>Somthing went wrong try again later!</p>";
    }

    echo '  </div>
          </aside>';
  }
}

function checkStatus(){
  if (isset($_GET["status"])){
    if ($_GET["status"] == "accMade"){
      return '<script src="home.js">accMadeMsg();</script>';
    }
  }
}

function emptyLoginInput($login, $pwd) {
  $ans;
  if(empty($login) || empty($pwd)) {
    $ans = true;
  } else {
    $ans = false;
  }
  return $ans;
}

function loginUser($conn, $login, $pwd){
  $uidExists = userExists($conn, $login, $login);

  if ($uidExists === false) {
    header("location: ../home.php?status=wrongLogin");
    exit();
  }

  $pwdCypher = $uidExists["usersPwd"];
  $pwdValidate = password_verify($pwd, $pwdCypher);

  if ($pwdValidate === false) {
    header("location: ../home.php?status=wrongPwd");
    exit();
  } else if ($pwdValidate === true) {
    session_start();
    $_SESSION["userId"] = $uidExists["usersId"];
    $_SESSION["userUname"] = $uidExists["usersUname"];
    header("location: ../home.php");
    exit();
  }
}

function setLoginForm(){
  return '<form method="POST" action="includes/loginHandler.php">
    <fieldset class="input-fields">
      <p>
        <label for="login">
          Login
          <p><input type="text" name="login" id="login"></p>
        </label>
      </p>
      <p>
        <label for="password">
          Password
          <p><input type="password" name="password" id="password"></p>
        </label>
      </p>
    </fieldset>
    <fieldset class="login-button">
      <p>
        <button type="submit" name="submit">Login</button>
        <button type="button" name="SignUp" id="SignUp">Sign Up</button>
      </p>
    </fieldset>
  </form>';
}

function setLoggedInMsg(){
  if (isset($_SESSION["userId"])) {
    return '<div class="logged-in">
      <p>Logged in as:</p>
      <h2>'.$_SESSION["userUname"].'</h2>
      <form class="logout" action="includes/logoutHandler.php" method="post">
        <button type="submit" name="logout">Log Out</button>
      </form>
      </div>';
  } else {
    return '<div class="logged-in">
      <p>FATAL ERROR</p>
      <h2>RELOAD PAGE</h2>
      </div>';
  }
}

function setAddBlogForm(){
  return '<form class="addBlog" action="" method="post">
    <p>
    <button type="button" name="addBlog" id="addBlog">Add/Edit a Post</button>
    </p>
    <p>
    <button type="button" name="addComment" id="addComment">Add a Comment</button>
    </p>
  </form>';
}

function setAddBlogCommentForm(){
  return '<form class="addBlog" action="" method="post">
    <p>
    <button type="button" name="addComment" id="addComment">Add a Comment</button>
    </p>
  </form>';
}

function setLoginrequestMsg(){
  return '<div class="pls-log-in">
    <p>
      <a href="home.php#login-box">Log in</a>
    </p>
    <p>To comment on blogs</p>
  </div>';
}

function emptyBloginput($blogTitle, $blogBody){
  $ans;
  if (empty($blogTitle) || empty($blogTitle)) {
    $ans = true;
  } else {
    $ans = false;
  }
  return $ans;
}

function createBlogPost($conn, $blogTitle, $blogBody){
  $sql = "INSERT INTO blogs (blogsTitle, blogsText) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../blogs.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $blogTitle, $blogBody);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../blogs.php?error=none");
  exit();
}

function getBlogData($conn, $blogId){
  $sql = "SELECT * FROM blogs WHERE blogsId = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: viewBlogs.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $blogId);
  mysqli_stmt_execute($stmt);

  $blogData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($blogData)) {
    return $row;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);

}

function emptyCommentinput($commentBody, $blogId){
  $ans;
  if (empty($commentBody) || empty($blogId)) {
    $ans = true;
  } else {
    $ans = false;
  }
  return $ans;
}

function createComment($conn, $comentAuthor, $commentBody, $blogId){
  $sql = "INSERT INTO comments (commentsAuthor, commentsText, blogsId) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../comments.php?error=stmtFailed");
    exit();
  }

  if (getBlogData($conn, $blogId) === false) {
    header("location: ../comments.php?error=noBlogFound");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssi", $comentAuthor, $commentBody, $blogId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../comments.php?error=none");
  exit();
}

function getCommentData($conn, $commentId){
  $sql = "SELECT * FROM comments WHERE commentsId = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: viewBlogs.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $commentId);
  mysqli_stmt_execute($stmt);

  $commentData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($commentData)) {
    return $row;
  } else {
    return false;
  }

  mysqli_stmt_close($stmt);

}

function generateBlogDisplay($blogId){
  global $conn;
  $blogData = getBlogData($conn, $blogId);
  if ($blogData !== false) {
    $outputData = '';
    $outputData .= '<div class="blog-post" id="blog-preview-'.$blogData['blogsId'].'">
       <div class="blog-title">'.$blogData['blogsTitle'].'</div>
       <hr>
       <div class="blog-body">'.$blogData['blogsText'].'</div>';
       for ($i=1; $i < 100; $i++) {
         $commentData = getCommentData($conn, $i);
         if ($commentData !== false) {
           if ($commentData['blogsId'] == $blogData['blogsId']) {
             $outputData .= '<div class="comment">
                               <hr>
                               <p>'.$commentData['commentsAuthor'].' - '.$commentData['commentsText'].'</p>
                               </div>';
           }
         }
       }
    $outputData.= '</div>';
    return $outputData;
  } else {
    return false;
  }
}

function generateAdminBlogDisplay($blogId){
  global $conn;
  $blogData = getBlogData($conn, $blogId);
  if ($blogData !== false) {
    $outputData = '';
    $outputData .= '<div class="blog-post" id="blog-preview-'.$blogData['blogsId'].'">
       <div class="blog-title">'
       .$blogData['blogsTitle'].'
       <form class="blog-del-button-form" action="includes/blogDelHandler.php" method="post">
         <input type="number" name="blogId" value="'.$blogData['blogsId'].'">
         <button type="submit" name="delete">Delete Post</button>
       </form>
       </div>
       <hr>
       <div class="blog-body">'.$blogData['blogsText'].'</div>';
       for ($i=1; $i < 100; $i++) {
         $commentData = getCommentData($conn, $i);
         if ($commentData !== false) {
           if ($commentData['blogsId'] == $blogData['blogsId']) {
             $outputData .= '<div class="comment">
                               <hr>
                               <p>'.$commentData['commentsAuthor'].' - '.$commentData['commentsText'].'</p>
                               <form class="comment-del-button-form" action="includes/commentDelHandler.php" method="post">
                                 <input type="number" name="commentId" value="'.$commentData['commentsId'].'">
                                 <button type="submit" name="delete">Delete Comment</button>
                               </form>
                               </div>';
           }
         }
       }
    $outputData.= '</div>';
    return $outputData;
  } else {
    return false;
  }
}

function generateBlogCard($blogId){
  global $conn;
  $blogData = getBlogData($conn, $blogId);
  if ($blogData !== false) {
    $outputData = '';
    $outputData .= '<div class="card big animated" id="blog-'.$blogData['blogsId'].'">
       <h2 class="card-header">'.$blogData['blogsTitle'].'</h2>
       <div class="date-time">
         <p>'.$blogData['blogsTime'].'</p>
       </div>
       <hr>
       <div class="content">
         <p>'.$blogData['blogsText'].'</p>
       </div>';
       for ($i=1; $i < 100; $i++) {
         $commentData = getCommentData($conn, $i);
         if ($commentData !== false) {
           if ($commentData['blogsId'] == $blogData['blogsId']) {
             $outputData .= '<div class="comment">
                               <hr>
                               <p>'.$commentData['commentsAuthor'].' - '.$commentData['commentsText'].'</p>
                               </div>';
           }
         }
       }
    $outputData.= '</div>';
    return $outputData;
  } else {
    return false;
  }
}

function deleteBlogPost($conn, $blogId){
  $sql = "DELETE FROM blogs WHERE blogsId = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../blogs.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $blogId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../blogs.php?status=blogDeleted");
  exit();

}

function deleteComment($conn, $commentId){
  $sql = "DELETE FROM comments WHERE commentsId = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../blogs.php?error=stmtFailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $commentId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../blogs.php?status=commentDeleted");
  exit();

}

function generatePreview($title, $text){
  $outputData = '';
  $outputData .= '<div class="page-dampener">
    <div class="card big">
      <h2 class="card-header">'.$title.'</h2>
      <div class="date-time">
        <p>'.date("Y-m-t h:i:s").'</p>
      </div>
      <hr>
      <div class="content">
        <p>'.$text.'</p>
      </div>
      <form class="prview-inputs" action="includes/addBlogsHandler.php" method="post">
        <input type="text" name="blog-title" value="'.$title.'">
        <input type="text" name="blog-body" value="'.$text.'">
        <p>
          <button type="submit" name="end-preview">Back to Edit</button>
          <button type="submit" name="submit-blog">Submit Blog</button>
        </p>
      </form>
    </div>';

  return $outputData;
}
