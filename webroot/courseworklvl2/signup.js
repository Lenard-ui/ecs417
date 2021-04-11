
function goHome() {
  location.href='home.php';
}

let homeButton = document.getElementById('back-home');
if (homeButton) {
  homeButton.addEventListener('click', goHome);
}
