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
        <p>Hey there! I am Kem Lenny Ibodi better known as Kemy. Welcome to my site! while I would love to tell you all about myself, I am quite pressed for time at the moment... so here is some randomly generated text for you to enjoy:</p>
        <p>
          A long black shadow slid across the pavement near their feet and the five Venusians, very much startled, looked overhead. They were barely in time to see the huge gray form of the carnivore before it vanished behind a sign atop a nearby
          building which bore the mystifying information "Pepsi-Cola."
        </p>
        </p>
        <p>
          The rain and wind abruptly stopped, but the sky still had the gray swirls of storms in the distance. Dave knew this feeling all too well. The calm before the storm. He only had a limited amount of time before all Hell broke loose, but he
          stopped to admire the calmness. Maybe it would be different this time, he thought, with the knowledge deep within that it wouldn't.
        </p>
      </div>
    </div>
    <div class="card big animated" id="Projects">
      <h2 class="card-header">Things I do</h2>
      <hr>
      <div class="content">
        <p>This Pannel will contain Projects I am currently working on and links to my github repos but again enjoy RNG:</p>
        <p>
          They rushed out the door, grabbing anything and everything they could think of they might need. There was no time to double-check to make sure they weren't leaving something important behind. Everything was thrown into the car and they sped
          off. Thirty minutes later they were safe and that was when it dawned on them that they had forgotten the most important thing of all.
        </p>
        <p>
          He sat staring at the person in the train stopped at the station going in the opposite direction. She sat staring ahead, never noticing that she was being watched. Both trains began to move and he knew that in another timeline or in another
          universe, they had been happy together.
        </p>
      </div>
    </div>
    <div class="card big animated" id="Education">
      <h2 class="card-header">My Experiences</h2>
      <hr>
      <div class="content">
        <p>This Card will contain facts about my Education... As I used to take Latin courses This will be randomly generated paragraphs in lazin...</p>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce nec pharetra odio. Cras cursus sem id posuere gravida. Nullam a pellentesque velit. Nam massa libero, ultrices a justo eget, dictum tempor lectus. Maecenas egestas, turpis vel
          varius ultricies, metus dui dignissim orci, non tincidunt libero tellus in nulla. Cras vel dolor efficitur, cursus diam id, interdum magna. Donec ipsum lorem, pretium nec luctus eu, pulvinar faucibus nisl. Sed ac posuere diam, et dictum
          nisl. Quisque bibendum at nunc sit amet euismod. Nulla lobortis convallis mollis. Etiam tincidunt, arcu eget facilisis suscipit, quam lorem imperdiet libero, a maximus sapien nulla ut lorem. Vestibulum hendrerit elit lacus, tempus hendrerit
          lorem semper in. Donec dignissim vehicula consectetur. Proin posuere felis eu vestibulum congue. Nunc et velit est. Nam vitae nulla maximus, imperdiet justo quis, euismod purus.
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
