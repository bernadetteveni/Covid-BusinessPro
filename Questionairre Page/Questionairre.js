window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");

// var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

function survey() {
  var cards = document.getElementById('cards');
  cards.style.display = 'none';
  var survey = document.getElementById('survey');
  survey.style.display = 'block';
}

function locations() {
  var cards = document.getElementById('cards');
  cards.style.display = 'none';
  var locations = document.getElementById('locations');
  locations.style.display = 'block';
}
