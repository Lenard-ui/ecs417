function goToAddBlogs() {
  location.href='blogs.php';
}
function goToAddComments() {
  location.href='comments.php';
}

let newBlogButton = document.getElementById('addBlog');
if (newBlogButton) {
  newBlogButton.addEventListener('click', goToAddBlogs);
}
let newCommentButton = document.getElementById('addComment');
if (newCommentButton) {
  newCommentButton.addEventListener('click', goToAddComments);
}
