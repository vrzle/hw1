  <!DOCTYPE html>
<html>
  <head>
    <title> VlogCinema - Home </title>
    <link rel="stylesheet" href="base.css">

    <script src="home.js" defer="true"></script>
    <script src="preferiti.js" defer="true"></script>
    <script src="dettagli.js" defer="true"></script>
    
    
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alkatra&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
      <header1>
        <nav>
        <a href="home.php" id="logo">
                <strong>vl</strong>og<strong>c</strong>inema
                </a>
            <div id="link">
                <a href="home.php">Home</a>
                
                <?php
                session_start();
               
                  if(!isset($_SESSION['username']))
                  {
                   echo "<a id='login' href='login.php'>Login</a>";
                  }
                  else{
                    echo "<a id='user' href='profile.php'><img src='user.png'> ";
                    echo $_SESSION["username"] . " </a>";
                    echo "<a href='search.php'>Cerca</a>";
                    echo "<a href='most.php'>Top 10</a>";
                    echo "<a id='logout' href='logout.php'>Logout</a>";
                  }
                
                ?>
                </div>
            
            <div class="hidden" id="menu_ext">
                  <a href="search.php">Cerca</a>
                  <a id="Top Ten" href="most.php.php">Most</a>
                  <?php
                    if(!isset($_SESSION['username']))
                      echo "<a id='login' href='login.php'>Login</a>";
                    else{
                      echo "<a id='cerca' href='search.php'>Cerca</a>";
                      echo $_SESSION["username"] . " </a>";
                      echo "<a id='logout' href='logout.php'>Logout</a>";
                    }
                  ?>
            </div>
            <div id="menu">
                  <div></div>
                  <div></div>
                  <div></div>
            </div>
        </nav>
        </header1>
        <header>
        <?php
            if(isset($_SESSION['username'])){
            echo "Benvenuto ";
            echo $_SESSION["username"];
            echo " !";
            }
        ?>

   <section>
   <h1>Benvenuto su </h1>
            <div id ='logo'>
            <strong>vl</strong>og<strong>c</strong>inema </div>
            <br>Sfoglia film e ottieni l'aspetto dettagliato del tuo film preferito.
            </div>
            <?php
                  if (!isset($_SESSION['username'])) {
                  echo "<div id='b'>";
                  echo "<a class='button' id='acc' href='login.php'>Accedi</a>";
                  echo "<a class='button' id='reg' href='signin_hw1.php'>Registrati</a>";
                  echo "</div>";
                  }
                  else
                  echo "<a id='most' href=search.php>Sfoglia i film ora</a>";
              ?>
   </section>
                </header>
                <div id=top>
  <?php
 

  if (isset($_SESSION['username'])) {
    $apiKey = "k_xnnn3av9";
    $limit = 20;

    $url = 'https://imdb-api.com/it/API/ComingSoon/' . $apiKey;

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
      echo '<h3> i titoli del momento</h3>';
      echo '<section2>';
     
  echo'<div class="scroll-arrow left">&lt;</div>';
  
  


      foreach ($items as $item) {
        
        $image = $item['image'];
        $releaseDate = $item['releaseState'];
        $filmId = $item['id'];

        echo '<section1>';
        echo '<img src="' . $image . '" alt="Immagine del film" class="film-image"><br>';
        echo '<p>Data di uscita: ' . $releaseDate . '</p>';
        echo '<img src="cuore_vuoto.png" alt="Preferiti" class="preferiti-icon" data-film-id="' . $filmId . '" onclick="aggiungiPreferito(\'' . $filmId . '\')"><br><br>';
        echo '<a href="dettagli_film.php?id=' . $filmId . '">Mostra dettagli</a>';
        echo '</section1>';
        
      }
    } else {
      echo 'Nessun film in arrivo trovato.';
    }
    echo '<div class="scroll-arrow right">&gt;</div>';
  }
  ?>
   </div>
   
</header>

    
     <footer>
          <p><strong>Virzì Letizia - 1000001895</strong></p>
     </footer>
  </body>
</html>