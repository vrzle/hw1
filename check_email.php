<?php
if(isset($_GET['q'])){
    
    $conn= mysqli_connect("localhost","root","","cinema");
    $email = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT email FROM user WHERE email = '$email'";

    $res = mysqli_query($conn, $query);
    $emailArray=Array();
    if(mysqli_num_rows($res)>0){
        $emailArray=array('exists'=>true);
    }else{
        $emailArray=array('exists'=>false);
    }
    echo json_encode($emailArray);

    mysqli_close($conn);
}
?>