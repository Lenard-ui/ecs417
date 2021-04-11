<?php

  session_start();

  require_once 'includes/dataStream.php';
  include 'includes/metaLinks.php';

  if (isset($_SESSION["userUname"])) {
    // vibe
  } else {
    header("location: home.php?status=accessDenied");
    exit();
  }

  echo setHeader();

?>

<body class="blog-page">
  <header id="page-top">
    <h1>Add a public Comment</h1>
  </header>
  <article class="blog-page-center">
    <section class="blog-form">
      <form method="POST" action="includes/addCommentHandler.php">
        <legend class="title">Add a Comment</legend>
        <fieldset class="blog-inputs">
          <p class="blog-title-area">
            <label for="blog-number">
              Type the blognumber here
              <p><input type="number" name="blog-number" id="blog-number" class="blogs-text-inputs" required></p>
            </label>
          </p>
          <p class="blog-body-area">
            <label for="comment-body">
              Comment text here
              <p><textarea type="text" name="comment-body" id="comment-body" class="blogs-text-inputs"></textarea></p>
            </label>
          </p>
        </fieldset>
        <fieldset class="blog-operations">
          <p id="buttons">
            <button type="submit" name="submit-comment" id="submit-comment">Submit</button>
            <button type="reset">Clear</button>
          </p>
        </fieldset>
      </form>
    </section>
    <section class="blog-box">
      <div class="scroll-box card">
        <?php
         $blogs = '';
         for ($i=30; $i > 0; $i--) {
           if (generateBlogDisplay($i) !== false) {
             $blogs .= generateBlogDisplay($i);
           }
         }
         echo $blogs;
         ?>
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
