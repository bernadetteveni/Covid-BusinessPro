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

function finishedSurvey() {
  var cards = document.getElementById('cards');
  cards.style.display = 'grid';
  var survey = document.getElementById('survey');
  survey.style.display = 'none';
}

function finishedLocations() {
  var cards = document.getElementById('cards');
  cards.style.display = 'grid';
  var locations = document.getElementById('locations');
  locations.style.display = 'none';
}
