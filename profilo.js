document.getElementById("eliminaProfiloForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita il comportamento di default del form
    
    // Conferma l'eliminazione del profilo
    if (confirm("Sei sicuro di voler eliminare il tuo profilo? Questa azione non può essere annullata.")) {
      // Invia la richiesta di eliminazione del profilo al server
      fetch("elimina_profilo.php", {
        method: "POST"
      })
      .then(function(response) {
        if (response.ok) {
          // Reindirizza l'utente alla pagina di login dopo l'eliminazione del profilo
          window.location.href = "login.php";
        } else {
          alert("Si è verificato un errore durante l'eliminazione del profilo. Riprova più tardi.");
        }
      })
      .catch(function(error) {
        console.log(error);
        alert("Si è verificato un errore durante l'eliminazione del profilo. Riprova più tardi.");
      });
    }
  });
  