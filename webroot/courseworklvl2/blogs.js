function getQueryMsg() {
  const params = new URLSearchParams(window.location.search);
  if (params.has('status') || params.has('error')) {
    const val = params.get('status')
    const val2 = params.get('error');;
    if (val == 'blogDeleted') {
      window.alert("Blogpost was deleted! if it is still there delete all comments 1st");
    } else if (val == 'commentDeleted') {
      window.alert("Comment was deleted for ever!");
    } else if (val2 == 'stmtFailed') {
      window.alert("Something went wrong!");
    } else if (val2 == 'emptyTitleInput') {
      window.alert("Enter a Title!");
      if (blogTitle) {
        blogTitle.class += " highlighted";
      }
    } else if (val2 == 'emptyBodyInput') {
      window.alert("The Post has no text!");
      if (blogBody) {
        blogBody.class += " highlighted";
      }
    } else if (val2 == 'fullyEmptyInput') {
      if (blogTitle&&blogBody) {
        blogTitle.class += " highlighted";
        blogBody.class += " highlighted";
      }
      window.alert("No title, no text, no blog!");
    } else if (val2 == 'none') {
      window.alert("Full success");
    }
  }
}
function displayClearMsg() {
  alert('Form Cleared!');
}
let newCommentButton = document.getElementById('clear-form');
if (newCommentButton) {
  newCommentButton.addEventListener('click', displayClearMsg);
}

var blogTitle = document.getElementById('blog-title');
var blogBody = document.getElementById('blog-body');

getQueryMsg();
