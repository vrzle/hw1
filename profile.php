<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("location: home.php");
  exit();
}


// Connessione al database
$conn = mysqli_connect("localhost", "root", "", "hw1");

// Verifica la connessione
if (!$conn) {
  die("Connessione al database fallita: " . mysqli_connect_error());
}

require 'preferiti.php';

// Ottieni le informazioni dell'utente
$username = $_SESSION['username'];
$query = "SELECT * FROM utenti WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Verifica se l'utente esiste nel database
if (!$row) {
  die("Utente non trovato nel database");
}

// Ottieni l'ID dell'utente
$user_id = $row['user_id'];

// Ottieni i preferiti dell'utente
$query = "SELECT * FROM preferiti WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);


?>

<?php
?>
<!DOCTYPE html>
<html>
<head>
  <title>VlogCinema - Profilo</title>
  <link rel="stylesheet" href="profilo.css">
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
<body>
<section>
  <h1>Profilo Utente</h1>

  <h2>Informazioni personali:</h2>
  <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
  <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
  <p><strong>Nome:</strong> <?php echo $row['nome']; ?></p>
  <p><strong>Cognome:</strong> <?php echo $row['cognome']; ?></p>
 
  <h2>Preferiti:</h2>
  <section1>
  <?php
  if (mysqli_num_rows($result) > 0) {
    while ($preferito = mysqli_fetch_assoc($result)) {
      $filmId = $preferito['film_id'];
      
      // Effettua una richiesta all'API IMDb per ottenere i dettagli del film
      $apiKey = "k_xnnn3av9";
      $url = 'https://imdb-api.com/it/API/Title/' . $apiKey . '/' . $filmId;
      $response = file_get_contents($url);
      $data = json_decode($response, true);
      
      if ($data && isset($data['title'])) {
        $title = $data['title'];
        $image = $data['image'];
        
        echo '<div>';
        echo '<h3>' . $title . '</h3>';
        echo '<img src="' . $image . '" alt="Immagine del film">';
        echo '<img src="cuore_vuoto.png" alt="Preferiti" class="preferiti-icon" data-film-id="' . $filmId . '" onclick="aggiungiPreferito(\'' . $filmId . '\')">';
        echo '</div>';
      }
    }
  } else {
    echo '<p>Nessun film preferito trovato.</p>';
  }
  ?>
  </section1>
  </section>
  <footer>
    <p>
      <strong>Virzì Letizia - 1000001895</strong>
    </p>
  </footer>
</body>
</html>




