<?php

session_start();

if (!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}
if ($_SESSION['stanowisko'] != 'Kelner'){
    header('Location: przekierowanie.php');
    exit();

}

?>

tutaj dodajemu zamoiwienie
