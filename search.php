
<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location: home.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>VlogCinema - TopTen</title>
  <link rel="stylesheet" href="search.css">
  <script src="script.js" defer="true"></script>
  <script src="dettagli.js" defer="true"></script>
  
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
      <a id='Top Ten' href='most.php'>Top-Ten</a>
    </div>

    <div id="menu">
      <div></div>
      <div></div>
      <div></div>
    </div>

  
</header>
<div class="hidden" id="menu_ext">
      <a id="Top Ten" href="most.php">Most</a>
      <?php
        echo "<a id='button' href='most.php'>Top-Ten</a>";
        echo $_SESSION["username"] . " </a>";
        echo "<a id='logout' href='logout.php'>Logout</a>";
      ?>
    </div>
    </nav>
             
<div class="container">
            <div class="sbox">

                <div>
                    <center>
                        <div class="content">
                            <h1 style="color: white">MoviesInfo: Information about over 10k+ movies</h1>
                        </div>
                    </center>
                    <form id="search-form">
                    <input type="text" id="film_title" name="film_title" placeholder="Titolo del film..."required>
                    <button type="submit" id="cerca">Cerca</button>
</form>
                </div>
            </div>
</header>
<?php
 if(isset($_SESSION['username'])){
    if (isset($_POST['film_title'])) {
    $filmTitle = $_POST['film_title'];
    $apiKey = "k_xnnn3av9"; // Inserisci qui la tua chiave API

    // URL dell'API di IMDb per la ricerca
    $baseURL = 'https://imdb-api.com/it/API/Search/' . $apiKey . '/';

    // Costruisci l'URL completo
    $url = $baseURL . urlencode($filmTitle);

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
    if (isset($data['results'])) {
        $results = $data['results'];

        // Verifica se ci sono risultati
        if (count($results) > 0) {
            // Mostra solo i primi 20 risultati
            $results = array_slice($results, 0, 20);

            // Stampa la lista dei film
            echo '<h2>Risultati della ricerca:</h2>';
            echo '<ul id="results-list"></ul>';
        } else {
            echo 'Nessun risultato trovato per il titolo del film inserito.';
        }
    }
}
}
?>
<div id=ris>
<h2>Risultati della ricerca:</h2>
<ul id="results-list"></ul>
</div>
</header>

</body>
<footer>
    <p>
      <strong>Virzì Letizia - 1000001895</strong>
    </p>
  </footer>
</html>
