// Funzione per gestire il clic sul cuore per aggiungere/rimuovere dai preferiti
// Funzione per l'aggiunta o la rimozione dei preferiti
function aggiungiPreferito(filmId) {
    var request = new XMLHttpRequest();
    request.open('POST', 'preferiti.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function() {
      if (request.readyState === 4 && request.status === 200) {
        cambiaIconaCuore(filmId); // Cambia l'immagine del cuore
      }
    };
    var params = 'film_id=' + filmId;
    request.send(params);
  }
  
  // Funzione per cambiare l'immagine del cuore
  function cambiaIconaCuore(filmId) {
    var cuoreIcon = document.querySelector('img[data-film-id="' + filmId + '"]');
    if (cuoreIcon && cuoreIcon.src.includes('cuore_pieno.png')) {
      cuoreIcon.src = 'cuore_vuoto.png';
    } else if (cuoreIcon) {
      cuoreIcon.src = 'cuore_pieno.png';
    }
  }
  