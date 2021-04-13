<?php

  session_start();

  require_once 'includes/dataStream.php';
  include 'includes/metaLinks.php';

  echo setHeader();

?>

<body>
  <header id="page-top">
    <h1>Kem L. Ibodi</h1>
  </header>
  <aside class="left-side">
    <div class="nav-links box">
      <nav class="navbox-side">
        <p>
          <a href="#About-Me">About Me</a>
        </p>
        <p>
          <a href="#Projects">Projects</a>
        </p>
        <p>
          <a href="#Education">Experiences</a>
        </p>
        <p>
          <a href="#page-bottom">My Blogs</a>
        </p>
      </nav>
    </div>
    <div class="page-color-slider box">
      <form action="" method="post" id="colorMode">
        <legend>Light | Dark</legend>
        <p>
          <label class="switch">
            <!-- <input type="submit" name="darkMode" id="LD-Switch"> -->
            <?php
              echo setColorButton(getColorMode());
             ?>
            <span class="slider" id="ld-slider"></span>
          </label>
        </p>
      </form>
    </div>
  </aside>
  <aside class="right-side">
    <div class="login box" id="login-box">
      <?php

        if (isset($_SESSION["userId"])) {
          echo setLoggedInMsg();
        } else {
          echo setLoginForm();
        }

       ?>
    </div>
    <div class="contacts box">
      <p>
        Contact Me!
      </p>
      <figure class="insta-pic">
        <figcaption>
          <a href="https://www.instagram.com/kem_lenard/" title="link to my Insta"> instagram.com/kem_lenard/</a>
        </figcaption>
        <img src="images\2muchsun.jpg" alt="Nope!" title="↓Check out my Instagram↓">
      </figure>
    </div>
  </aside>
  <article class="page-center">
    <div class="card big animated" id="About-Me">
      <h2 class="card-header">About Me!</h2>
      <hr>
      <div class="content">
        <p>Hey there! I am Kem Lenny Ibodi better known as Kemy. Welcome to my site!</p>
        <p>
          If I had to describe my lifestyle in one phrase it would be “everything worth doing, is worth doing well”. I think this is a pretty accurate description of the way I treat my work, hobbies and private life. When given a task or when I set my mind to something I will make sure to see it through until the very end because there would be no meaning in having started something without experiencing its end. For the most part I enjoy doing what I do and will not sign up to do something if I know I would not want to do it well, while this life style might be a little taxing at times it never fails to reward.
        <p>
          Also ... I don't know if you noticed but this page has a dark mode ... why not check it out.
        </p>
      </div>
    </div>
    <div class="card big animated" id="Projects">
      <h2 class="card-header">Things I do</h2>
      <hr>
      <div class="content">
        <p>As I will elaborate on later I am a computer science student (which is why) you are currently on a website I made from scratch. </p>
        <p>
          For now please feel free to check out my GitHub which is linked in the footer of this page.
        </p>
        <p>
          You can also find me on social media such as YouTube, Twitter and Instagram by following the links in the footer.
        </p>
        <p>
          Don’t worry I will keep this article up to date in the near future.
        </p>
      </div>
    </div>
    <div class="card big animated" id="Education">
      <h2 class="card-header">My Experiences</h2>
      <hr>
      <div class="content">
        <p>Coming from Germany I achieved the “Zeugnis der Allgemeinen Hochschulreife” in a Steiner school in northern Germany excelling in Maths, English, Biology and Latin.</p>
        <p>
          I am now a student at Queen Mary University of London in my first year of computer science.
        </p>
        <p>
          As for my technological background, I taught myself the basics of programming using python at the age of 13. I have always had a curiosity for this subject as I have always loved to play video games and started asking myself how the work at a young age. Specifically, as I found an exploit in a Super Mario game at the age of 12 which gave the player infinite lives, I wondered if he games makers added it into the game on purpose or not.
        </p>
        <p>
          For the last two years I spent in Germany I worked as an assistant in a repair shop for smartphones and gadgets. Experiencing complex phone repairs first hand, handling software issues of customers and replacing phone screens, batteries etc. were a weekly occurrence for me during that time.
        </p>
      </div>
    </div>
    <?php
     $blogs = '';
     for ($i=100; $i > 0; $i--) {
       if (generateBlogCard($i) !== false) {
         $blogs .= generateBlogCard($i);
         break;
       }
     }
     echo $blogs;
     ?>
    </div>
  </article>
  <footer>
    <div class="contact-links" id="page-bottom">
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
    <div class="back-to-top">
      <a href="#page-top">back to top</a>
    </div>
  </footer>
</body>

<?php
  echo setJSFooter();
 ?>

</html>
