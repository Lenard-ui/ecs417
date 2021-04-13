<?php

  session_start();

  require_once 'includes/dataStream.php';
  include 'includes/metaLinks.php';

  echo setHeader();

 ?>


 <body>
   <header id="page-top">
     <h1>Personal Blog</h1>
   </header>
   <aside class="right-side">
     <div class="addBlog box" id="addBlog-box">
       <?php

         if (isset($_SESSION["userId"])) {
           if ($_SESSION["userId"] == 1 || $_SESSION["userId"] == 2) {
             echo setAddBlogForm();
           } else {
             echo setAddBlogCommentForm();
           }
         } else {
           echo setLoginrequestMsg();
         }

        ?>
     </div>
   </aside>
   <article class="page-center">
     <?php
      $blogs = '';
      for ($i=1; $i < 100; $i++) {
        if (generateBlogCard($i) !== false) {
          $blogs .= generateBlogCard($i);
        }
      }
      echo $blogs;
      ?>
   </article>
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
