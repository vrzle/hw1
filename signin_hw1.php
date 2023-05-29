<?php
    session_start();

        if(isset($_POST["username"])&&isset($_POST["password"])&&
        isset($_POST["nome"])&&isset($_POST["cognome"])
        &&isset($_POST["email"])&&isset($_POST["confpassword"])){

            $error=array();
            $conn= mysqli_connect("localhost","root","","hw1");

            if(!preg_match('/^[a-zA-Z0-9_]{1,10}$/',$_POST['username'])){
                $error[]="Username non valido!";
            }
            else{
                $username= mysqli_real_escape_string($conn,$_POST['username']);
                $query=" SELECT username from utenti where username ='".$username."'";
    
                $res=mysqli_query($conn,$query);

                if(mysqli_num_rows($res)>0){
                    $error[]="Username già esistente!";
                }
            }

            if(strlen($_POST['password'])<8){
                $error[]="Caratteri non sufficienti!";
            }

            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $error[]="Email non valida!";
            }else {
                $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
                $res = mysqli_query($conn, "SELECT email FROM utenti WHERE email = '$email'");
                if (mysqli_num_rows($res) > 0) {
                    $error[] = "Email già utilizzata";
                }
            }

            if(strlen($_POST['nome'])==0){
                $error[]="Inserisci un nome!";
            }

            if(strlen($_POST['cognome']==0)){
                $error[]="Inserisci un cognome!";
            }

            if(strcmp($_POST['confpassword'],$_POST['password'])!=0){
                $error[]="Password non corrispondenti!";
            }
            if(count($error)==0){
                $nome= mysqli_real_escape_string($conn,$_POST['nome']);
                $cognome= mysqli_real_escape_string($conn,$_POST['cognome']);
                $password= mysqli_real_escape_string($conn,$_POST['password']);
                $password = password_hash($password, PASSWORD_BCRYPT);

                $query_1 = "INSERT INTO utenti (nome, cognome, username, email, pwd)
                VALUES ('" . $nome . "', '" . $cognome . "', '" . $username . "', '" . $email . "', '" . $password . "')";
    
    

                 if(mysqli_query($conn,$query_1)){
                     $_SESSION['username']=$_POST['username'];
                     header("Location: home.php");     
                     mysqli_free_result($res);
                     mysqli_close($conn);
                     exit;
                 }
            }
        }
?>
<html>
  <head>
    <title> VlogCinema - Registrati </title>
    <link rel="stylesheet" href="signin_hw1.css"/> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <script src="signin_hw1.js" defer="true"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>

       <header>
       <div id="registrati">
                <a href="home.php" class="titolo">
                <strong>vl</strong>og<strong>c</strong>inema
                </a>
                <h3>Registrati!</h3>
               
                <form name="signin" method="post">
                <section>
                    <div>
                <p id="nome">
                    <label>Nome</label>
                    <input type="text" name="nome" <?php if(isset($_POST["nome"])){echo "value=".$_POST["nome"];} ?>>
                    <span></span>
                </p>
                <p id="cognome">
                    <label>Cognome</label>
                    <input type="text" name="cognome" <?php if(isset($_POST["cognome"])){echo "value=".$_POST["cognome"];} ?>>
                    <span></span>
                </p>
                    </div>
    </section>
    <section>
        <div>
                <p id="email">
                    <label>E-Mail</label>
                    <input type="text" name="email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                    <span></span>
                </p>
                <p id="username">
                    <label>Username</label>
                    <input type="text" name="username" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                    <span></span> 
                </p>
        </div>
    </section>
    <section>
        <div>
                <p id="password">
                    <label>Password</label>
                    <input type="password" name="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                    <span></span>
                </p>
                <p id="conferma">
                    <label>Conferma Password</label>
                    <input type="password" name="confpassword" <?php if(isset($_POST["confpassword"])){echo "value=".$_POST["confpassword"];} ?>>
                    <span></span>
                </p>
        </div>
    </section>   
                <p id="consenti"> 
                    <label>
                        <input type='checkbox' name='allow' value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>>
                        <label for='allow'>Acconsento al trattamento dei dati personali</label>
                    </label>
                </p>
                <p id="registrati">
                    <input id="accesso" type='submit' value="Registrati">
                </p>
                <p id="accedi">
                    Hai già un account?<a href="login.php">Accedi</a>
                </p>
         </form>
        </header>
  </body>
</html>