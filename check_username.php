<?php 

   if(isset($_GET['q'])){
    
        $conn= mysqli_connect("localhost","root","","hw1");
        $username = mysqli_real_escape_string($conn, $_GET["q"]);

        $query = "SELECT username FROM utenti WHERE username = '$username'";

        $res = mysqli_query($conn, $query);
        $userArray=Array();
        if(mysqli_num_rows($res)>0){
            $userArray=array('exists'=>true);
        }else{
            $userArray=array('exists'=>false);
        }
        echo json_encode($userArray);

        mysqli_close($conn);
    }
?>