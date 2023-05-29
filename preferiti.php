<?php
$conn = mysqli_connect("localhost", "root", "", "hw1");
if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

function aggiungiPreferito($filmId, $userId, $conn)
{
    $query = "INSERT INTO preferiti (user_id, film_id) VALUES ($userId, '$filmId')";
    mysqli_query($conn, $query);
}

function rimuoviPreferito($filmId, $userId, $conn)
{
    $query = "DELETE FROM preferiti WHERE user_id = $userId AND film_id = '$filmId'";
    mysqli_query($conn, $query);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filmId = $_POST['film_id'];
    $userId = 1; // Esempio: ID utente fisso per test

    // Controlla se il film è già nei preferiti dell'utente
    $query = "SELECT * FROM preferiti WHERE user_id = $userId AND film_id = '$filmId'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Il film è già nei preferiti, quindi lo rimuove
        rimuoviPreferito($filmId, $userId, $conn);
    } else {
        // Il film non è nei preferiti, quindi lo aggiunge
        aggiungiPreferito($filmId, $userId, $conn);
    }
}

?>
