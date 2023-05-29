document.addEventListener('DOMContentLoaded', function() {
  var filmTitleInput = document.getElementById('film_title');
  var searchForm = document.getElementById('search-form');
  var resultsList = document.getElementById('results-list');

  filmTitleInput.addEventListener('input', function() {
    var filmTitle = filmTitleInput.value;
    var apiKey = "k_xnnn3av9"; // Inserisci qui la tua chiave API
    var baseURL = 'https://imdb-api.com/it/API/Search/' + apiKey + '/';
    var url = baseURL + encodeURIComponent(filmTitle);

    while (resultsList.firstChild) {
      resultsList.removeChild(resultsList.firstChild);
    }

    fetch(url)
      .then(function(response) {
        return response.json();
      })
      .then(function(data) {
        if (data.results && data.results.length > 0) {
          var results = data.results.slice(0, 20);

          results.forEach(function(result) {
            var title = result.title;
            var image = result.image;
            var filmId = result.id;

            var listItem = document.createElement('div');
            listItem.classList.add('album');

            var titleElement = document.createElement('h3');
            titleElement.textContent = title;
            listItem.appendChild(titleElement);

            var itemContainer = document.createElement('div');
            itemContainer.classList.add('item-container');

            var imageElement = document.createElement('img');
            imageElement.src = image;
            imageElement.alt = 'Immagine del film';
            itemContainer.appendChild(imageElement);

            listItem.appendChild(itemContainer);

       

            var detailsLink = document.createElement('a');
            detailsLink.href = 'dettagli_film.php?id=' + filmId;
            detailsLink.textContent = 'Mostra dettagli';
            listItem.appendChild(detailsLink);

            resultsList.appendChild(listItem);
          });
        } else {
          var noResultsItem = document.createElement('li');
          noResultsItem.textContent = 'Nessun risultato trovato per il titolo del film inserito.';
          resultsList.appendChild(noResultsItem);
        }
      })
      .catch(function(error) {
        console.log(error);
      });
  });

  searchForm.addEventListener('submit', function(event) {
    event.preventDefault();
  });
});

  
  