
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
  <link rel="stylesheet" href="most.css">
  <script src="preferiti.js" defer="true"></script>
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
</header>
<div id=testo>
<div >
            <h1>TOP 10</h1>
            <h4>Classifica imdb</h4><p>clicca su info per scoprire tutti i dettagli e guardare il trailer</p>
            </div>
   </div>
</div>

<section1>
    <?php
               
    if(isset($_SESSION['username'])){
    $apiKey = "k_xnnn3av9";
    $limit = 10;

    $url = 'https://imdb-api.com/it/API/Top250Movies/' . $apiKey;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);

    if ($response === false) {
      echo 'Errore nella richiesta API: ' . curl_error($curl);
      die();
    }

    curl_close($curl);

    $data = json_decode($response, true);

    if ($data === null) {
      echo 'Errore nella decodifica dei dati JSON: ' . json_last_error_msg();
      die();
    }

    if (isset($data['items'])) {
      $items = $data['items'];
      $items = array_slice($items, 0, $limit);
      $var = 1;

      foreach ($items as $item) {
        $title = $item['title'];
        $image = $item['image'];
        $filmId = $item['id'];
        echo '<section>';
        echo '<h1>' . $title . '</h1>';
        echo '<img src="' . $image . '" alt="Immagine del film" class="film-image"><br>';
        echo '<img src="cuore_vuoto.png" alt="Preferiti" class="preferiti-icon" data-film-id="' . $filmId . '" onclick="aggiungiPreferito(\'' . $filmId . '\')"><br><br>';
        echo '<a href="dettagli_film.php?id=' . $filmId . '">info</a>';
        echo '</section>';
    }

    } else {
      echo 'Nessun film popolare trovato.';
    }
}
    ?>
</section1>
  <footer>
    <p>
      <strong>Virzì Letizia - 1000001895</strong>
    </p>
  </footer>
</body>
</html>
