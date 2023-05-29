<?php

session_start();

if(isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
}
else{
    if(isset($_POST["username"])&&isset($_POST["password"])){

        $conn= mysqli_connect("localhost","root","","hw1");
        $username= mysqli_real_escape_string($conn,$_POST['username']);
        $query=" SELECT * from utenti where username ='".$username."'";

        $res=mysqli_query($conn,$query);

        if(mysqli_num_rows($res)>0){
            $entry=mysqli_fetch_assoc($res);
            if(password_verify($_POST['password'],$entry['pwd'])){
                $_SESSION["username"]=$_POST["username"];
                header("Location: home.php");
                mysqli_close($conn);
                exit();
          
            }
        }
    }
}



?>
<html>
  <head>
    <title> VLogCinema - Login </title>
    <link rel="stylesheet" href="login.css"/> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <script src="login.js" defer="true"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
       <header>
        <div id="accedi">
       <a href="home.php" class="titolo">
                <strong>vl</strong>og<strong>c</strong>inema
                </a>
                <form name="login" method="post">
                <h3> Effettua il Login</h3>
                <p>
                    <label>Username<input type="text" name="username"></label>
                </p>
                <p>
                    <label>Password<input type="password" name="password"></label>
                </p>
                <p>
                    <label><input id="accesso" type='submit' value="Accedi"></label>
                </p>
                <p>Non hai un account? <a href="signin_hw1.php">Registrati</a></p>
         </form>
         <?php
            if(isset($errore)){
                echo "<p>";
                echo "Credenziali errate!";
                echo "</p>";
            }
        ?>
        </div>
        </header>
  </body>
</html>