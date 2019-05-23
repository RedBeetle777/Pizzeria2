<?php
    session_start();
    $_SESSION['typ']="2";
    $_SESSION['logged_in']=false;
    $_SESSION['message']=' ';
    $mysqli=new mysqli('localhost', 'root', '','mydb' );
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $login=$mysqli->real_escape_string($_POST['login']);
        $haslo=md5($_POST['haslo']);
        
        $sql = "SELECT * FROM kucharz;
        $result = $mysqli->query( $sql );
        
        $user = $result->fetch_assoc();
        /*
         if ( $haslo== $user['haslo']) {
         $_SESSION['user_id'] = $user['idUzytkownik'];
         $_SESSION['logged_in']=true;
         if($user['typ']=="2")
         {
         $_SESSION['typ']="2";
         header("location: kucharz.php");
         }
         else
         {
         header("location: myProfileInfo.php");
         }
         }
         else  $_SESSION['message'] = "Błędne hasło!";
         */
    }
    
    ?>

