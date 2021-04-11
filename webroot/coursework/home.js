
function toggleColor() {
  if (getCookie('colorMode') === false) {
    setCookie('colorMode', 'dark', 1);
    location.reload();
  } else if (getCookie('colorMode') == 'dark') {
      setCookie('colorMode', 'light', 1);
      location.reload();
  } else if (getCookie('colorMode') == 'light'){
      setCookie('colorMode', 'dark', 1);
      location.reload();
  }
}

function goToSignup() {
  location.href='signup.php';
}

function getQueryMsg() {
  const params = new URLSearchParams(window.location.search);
  if (params.has('status')) {
    const val = params.get('status');
    if (val == 'accMade') {
      window.alert("Account has been created");
    } else if (val == 'wrongLogin') {
      window.alert("Login details wrong");
    } else if (val == 'emptyInput') {
      window.alert("Enter login details to log in");
    } else if (val == 'wrongPwd') {
      window.alert("Wrong Password");
    } else if (val == 'bruh') {
      window.alert("Something went wrong");
    } else if (val == 'getAllP@sswords') {
      window.alert("passwords loaded press ok to download");
      location.href='https://www.youtube.com/watch?v=Lrj2Hq7xqQ8';
    } else if (val == 'loggedOut') {
      window.alert("You logged out");
    } else if (val == 'accessDenied') {
      window.alert("Access Denied BIAAATCH");
    }
  }
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return false;
}

function insertBlogLink() {
  let i = 1;
  while (true) {
    let blogId = 'blog-'+i;
    let blogCard = document.getElementById(blogId);
    if (blogCard) {
      blogCard.innerHTML += '<p class="link-to-blog"><a href="viewBlogs.php">Link to Full blog</a></p>';
      break;
    }
    i++;
  }
}

var ldSlider = document.getElementById('ld-slider');
if (ldSlider) {
  ldSlider.addEventListener('click', toggleColor);
}
var signupButton = document.getElementById('SignUp');
if (signupButton) {
  signupButton.addEventListener('click', goToSignup);
}
getQueryMsg();
insertBlogLink();
