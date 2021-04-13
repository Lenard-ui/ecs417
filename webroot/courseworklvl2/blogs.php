<?php

  session_start();

  require_once 'includes/dataStream.php';
  include 'includes/metaLinks.php';

  if (isset($_SESSION["userUname"])) {
    if ($_SESSION["userUname"] == 'Lenard' || $_SESSION["userUname"] == 'Kem') {
      // vibe
    } else {
      header("location: home.php?status=accessDenied");
      exit();
    }

  } else {
    header("location: home.php?status=accessDenied");
    exit();
  }

  echo setHeader();

?>

<body class="blog-page">
  <header id="page-top">
    <h1>Add or Edit a Blogpost</h1>
  </header>
  <article class="blog-page-center">
    <?php

      if (isset($_GET['preview'])) {
        if ($_GET['preview'] == 'on') {
          $title = $_GET['blog-title'];
          $text = $_GET['blog-body'];
          echo generatePreview($title, $text);
        } elseif ($_GET['preview'] == 'off') {
          $blogtitle = $_GET['blog-title'];
          $blogtext = $_GET['blog-body'];
        } else {
          $blogtitle = '';
          $blogtext = '';
        }
      }

     ?>
    <section class="blog-form">
      <form method="POST" action="includes/addBlogsHandler.php">
        <legend class="title">Add a Blog</legend>
        <fieldset class="blog-inputs">
          <p class="blog-title-area">
            <label for="blog-title">
              Add a title
              <?php
                global $blogtitle;
                echo '<p><input type="text" name="blog-title" id="blog-title" class="blogs-text-inputs" required value="'.$blogtitle.'"></p>';
               ?>
            </label>
          </p>
          <p class="blog-body-area">
            <label for="blog-body">
              Blog text here
              <?php
                global $blogtext;
                echo '<p><textarea type="text" name="blog-body" id="blog-body" class="blogs-text-inputs">'.$blogtext.'</textarea></p>';
               ?>
            </label>
          </p>
        </fieldset>
        <fieldset class="blog-operations">
          <p id="buttons">
            <button type="submit" name="submit-blog" id="submit-blog">Submit</button>
            <button type="submit" name="preview-blog">Preview</button>
            <button type="reset">Clear</button>
          </p>
        </fieldset>
      </form>
    </section>
    <section class="blog-box">
      <div class="scroll-box card">
        <?php
         $blogs = '';
         for ($i=100; $i > 0; $i--) {
           if (generateAdminBlogDisplay($i) !== false) {
             $blogs .= generateAdminBlogDisplay($i);
           }
         }
         echo $blogs;
         ?>
        </div>
      </div>
    </section>
  </article>
  <aside></aside>
  <footer>
    <div class="contact-links">
      <p>Thanks for stopping by</p>
      <p>find me here...</p>
      <p>
        Instagram: <a href="https://www.instagram.com/kem_lenard/" title="link to my Insta">@kem_lenard/</a>
      </p>
      <p>
        Twitter: <a href="https://twitter.com/Lenard55463141">@Lenard</a>
      </p>
      <p>
        GitHub: <a href="https://github.com/Lenard-ui">Lenard-ui</a>
      </p>
      <p>
        YouTube: <a href="https://www.youtube.com/channel/UCskH7b1zOZMj0hUBmEJZVCw">LenTime</a>
      </p>
    </div>
    <nav class="footer-nav">
      | <a href="#page-top">back to top</a> | <a href="viewBlogs.php">back to blog view</a> | <a href="home.php">Home</a> |
    </nav>
  </footer>
</body>
<?php
  echo setJSFooter();
 ?>
</html>
