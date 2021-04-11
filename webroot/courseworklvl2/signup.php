<?php

  // session_start();

  include 'includes/metaLinks.php';

  echo setHeader();

?>

<body>
  <header id="page-top">
    <h1>Sign Up</h1>
  </header>
  <article class="page-center">
    <div class="card big signup">
      <form class="signup-form" action="includes/signupHandler.php" method="post">
        <p>
          <label for="uName">Username</label><br>
          <input type="text" name="uName" id="uName" placeholder="Enter a Username">
        </p>
        <p>
          <label for="email">Email</label><br>
          <input type="text" name="email" id="email" placeholder="Enter your Email">
        </p>
        <p>
          <label for="pwd">Your Password</label><br>
          <input type="password" name="pwd" id="pwd" placeholder="Enter a password">
        </p>
        <p>
          <label for="pwdrpt">Repeat Password</label><br>
          <input type="password" name="pwdrpt" id="pwdrpt" placeholder="Repeat your password">
        </p>
        <p>
          <button type="submit" name="sign-up">Sign up</button>
          <button type="button" name="back-home" id="back-home">Back</button>
        </p>
      </form>
    </div>
  </article>

<?php

  catchSignupError();

 ?>

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
      | <a href="#page-top">back to top</a> | <a href="home.php">Home</a> |
    </nav>
  </footer>
</body>
<?php
  echo setJSFooter();
 ?>
</html>
