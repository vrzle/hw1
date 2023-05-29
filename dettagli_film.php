<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location: home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>VlogCinema - Dettagli</title>
  <link rel="stylesheet" href="dettagli.css">
  <script src="dettagli.js" defer="true"></script>
  <script src="preferiti.js" defer="true"></script>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Alkatra&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <header>
  <nav>
  <a href="home.php" id="logo">
    <strong>vl</strong>og<strong>c</strong>inema
  </a>

  <div id="link">
    <a href="home.php">Home</a>
    <?php
      echo "<a id='user' href='profile.php'><img src='user.png'> ";
      echo $_SESSION["username"] . " </a>";
    ?>
    <a id='Top Ten' href='most.php'>Top ten</a>
    <a id='cerca' href='search.php'>Cerca</a>
  </div>
  <div id="menu">
    <div></div>
    <div></div>
    <div></div>
  </div>
</nav>
  <div class="hidden" id="menu_ext">
    <a id="Top Ten" href="most.php.php">Most</a>
    <?php
      echo "<a id='cerca' href='search.php'>Cerca</a>";
      echo $_SESSION["username"] . " </a>";
      echo "<a id='logout' href='logout.php'>Logout</a>";
    ?>
  </div>
</nav>


  
<?php
if (isset($_GET['id'])) {
    
    $filmId = $_GET['id'];
    $apiKey = "k_xnnn3av9"; // Inserisci qui la tua chiave API

    // URL dell'API di IMDb per ottenere i dettagli del film per ID
    $url = 'https://imdb-api.com/it/API/Title/' . $apiKey . '/' . $filmId;

    // Inizializza la sessione cURL
    $curl = curl_init();

    // Imposta l'URL della richiesta cURL
    curl_setopt($curl, CURLOPT_URL, $url);

    // Imposta l'opzione per ricevere la risposta come stringa
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Esegui la richiesta cURL e ottieni la risposta
    $response = curl_exec($curl);

    // Chiudi la sessione cURL
    curl_close($curl);

    // Decodifica la risposta JSON
    $data = json_decode($response, true);

    // Verifica se la risposta contiene dati validi
    if (isset($data['title'])) {
        $title = $data['title'];
        $image = $data['image'];
        $plotLocal = $data['plotLocal'];
        $year = $data['year'];
        $rating = $data['imDbRating'];
        $runtime = $data['runtimeMins'];
        $budget = $data['boxOffice']['budget'];
        $revenue = $data['boxOffice']['cumulativeWorldwideGross'];
        $actors = $data['stars'];

echo '<section>';
echo '<h1>Titolo: ' . $title . '</h1>';
echo '<img src="cuore_vuoto.png" alt="Preferiti" id="preferiti-icon" data-film-id="' . $filmId . '" onclick="aggiungiPreferito(\'' . $filmId . '\')"><br><br>';
echo '<section1>';
echo '<img src="' . $image . '" alt="Immagine del film"><br>';


echo '<table class="movie-details-table">';
echo '<tbody>';
echo '<tr>';
if (isset($data['genres'])) {
    echo '<td>Generi:</td> ';
    if (is_array($data['genres'])) {
        echo implode(', ', $data['genres']);
    } else {
        echo '<td>';
        echo $data['genres'];
        
    }
    echo '</td>';
    
}
echo '</tr>';
echo '<tr>';
echo '<td>Anno:</td>';
echo '<td>' . $year . '</td>';
echo '</tr>';
echo '<tr>';
echo '<td>Valutazione:</td>';
echo '<td>' . $rating . '</td>';
echo '</tr>';
echo '<tr>';
echo '<td>Budget:</td>';
echo '<td>' . $budget . '</td>';
echo '</tr>';
echo '<tr>';
echo '<td>Entrate:</td>';
echo '<td>' . $revenue . '</td>';
echo '</tr>';
echo '<tr>';
echo '<td>Durata:</td>';
echo '<td>' . $runtime . ' minuti</td>';
echo '</tr>';
echo '</tbody>';
echo '</table>';
echo '</section1>';
echo '<div id=trama><h3>Trama</h3>: ' . $plotLocal . '</div><br>';

        // Stampa i dettagli aggiuntivi
        echo '<button id="details-button" onclick="toggleDetails()">Mostra dettagli</button>';
        echo '<div id="details-section" style="display: none;">';
        echo '<h3>Dettagli aggiuntivi:</h3>';
        if (isset($data['awards'])) {
            echo 'Premi: ' . $data['awards'] . '<br>';
        }
        echo '<p>Attori: ';
        if (is_array($actors)) {
            echo implode(', ', $actors);
        } else {
            echo $actors;
        }
        if (isset($data['directors'])) {
            echo 'Registi: ';
            if (is_array($data['directors'])) {
                echo implode(', ', $data['directors']);
            } else {
                echo $data['directors'];
            }
            echo '<br>';
        }
        if (isset($data['writers'])) {
            echo 'Sceneggiatori: ';
            if (is_array($data['writers'])) {
                echo implode(', ', $data['writers']);
            } else {
                echo $data['writers'];
            }
            echo '<br>';
        }
        if (isset($data['productionCompanies'])) {
            echo 'Case di produzione: ';
            if (is_array($data['productionCompanies'])) {
                echo implode(', ', $data['productionCompanies']);
            } else {
                echo $data['productionCompanies'];
            }
            echo '<br>';
        }
        if (isset($data['countries'])) {
            echo 'Paesi: ';
            if (is_array($data['countries'])) {
                echo implode(', ', $data['countries']);
            } else {
                echo $data['countries'];
            }
            echo '<br>';
        }
        echo '</div>';
        echo '<script>
            function toggleDetails() {
                var detailsSection = document.getElementById("details-section");
                var detailsButton = document.getElementById("details-button");

                if (detailsSection.style.display === "none") {
                    detailsSection.style.display = "block";
                    detailsButton.innerHTML = "Nascondi dettagli";
                } else {
                    detailsSection.style.display = "none";
                    detailsButton.innerHTML = "Mostra dettagli";
                }
            }
        </script>';
    } else {
        echo 'Nessun risultato trovato per l\'ID del film.';
    }
}


// Funzione per estrarre l'ID del video di YouTube dal link del trailer
function extractYouTubeVideoId($url) {
    $videoId = '';

    if(preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $match) || preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $match) || preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $match) || preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $match)) {
        $videoId = $match[1];
    }

    return $videoId;
}

// Effettua la richiesta per ottenere il link del trailer da IMDb API
$trailerUrl = 'https://imdb-api.com/it/API/YouTubeTrailer/' . $apiKey . '/' . $filmId;
$trailerResponse = file_get_contents($trailerUrl);
$trailerData = json_decode($trailerResponse, true);
$youtubeApiKey='AIzaSyDj_8PFU-3lnWPtPKgBb0KkLhfKuaExvr0';

if(isset($trailerData['videoUrl'])) {
    $trailerLink = $trailerData['videoUrl'];

    // Estrai l'ID del video di YouTube dal link del trailer
    $videoId = extractYouTubeVideoId($trailerLink);

    // Effettua la richiesta per ottenere i dettagli del video di YouTube
    $youtubeApiUrl = 'https://www.googleapis.com/youtube/v3/videos?id=' . $videoId . '&key=' . $youtubeApiKey . '&part=snippet';
    $youtubeApiResponse = file_get_contents($youtubeApiUrl);
    $youtubeData = json_decode($youtubeApiResponse, true);

    if(isset($youtubeData['items'][0]['snippet']['title'])) {
        $videoTitle = $youtubeData['items'][0]['snippet']['title'];

        // Stampa il player video di YouTube
        echo '<div class="trailer-container">';
        echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
        echo '</div>';
    } else {
        echo 'Nessun video di YouTube disponibile per questo film.';
    }
} else {
    echo 'Nessun trailer disponibile per questo film.';
}









            // Verifica se l'URL della pagina precedente contiene "most.php"
            if (strpos($_SERVER['HTTP_REFERER'], 'most.php') !== false) {
                // Se proveniamo da most.php, stampa il pulsante "Torna indietro" per tornare a quella pagina
                echo '<br><a href="most.php">Torna indietro</a>';
            } else {
                // Altrimenti, stampa il pulsante "Torna alla ricerca" per tornare alla pagina di ricerca
                echo '<br><a href="search.php">Torna alla ricerca</a>';
            }

            echo '</section>';
     
?>


</header>
  <footer>
    <p>
      <strong>Virzì Letizia - 1000001895</strong>
    </p>
  </footer>
</body>
</html>



