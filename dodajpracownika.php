<?php

session_start();

if (!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}
if ($_SESSION['stanowisko'] != 'Manager'){
    header('Location: przekierowanie.php');
    exit();

}
$dane = array();//imie,nazwisko,login,haslo
require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}

$blad = false;
if(isset($_GET['imie'])){
    if (strlen($_GET['imie']) == 0){
        $blad = true;
        echo "nie podano imienia!<br/>";
    }else array_push($dane, $_GET['imie']);
}else $blad = true;
if(isset($_GET['nazwisko'])){
    if (strlen($_GET['nazwisko']) == 0){
        $blad = true;
        echo "nie podano nazwiska!";
    }else array_push($dane, $_GET['nazwisko']);
}else $blad = true;
if (!$blad){
    array_push($dane, substr($_GET['imie'],0,3).
        substr($_GET['nazwisko'],0,3));
    echo "login: ".$dane[2]." haslo: ".rand(1000,9999);

}
?>

    <form action="pracownicy.php">

        <button type="submit">
            POWRÓT
        </button>

    </form>
<br/>


<fieldset>
    <legend align="left">DANE NOWEGO PRACOWNIKA</legend>
    <form action="dodajpracownika.php">
        <input type="text" name="imie" > :IMIE<br/>
        <input type="text" name="nazwisko" > :NAZWISKO<br/>
<!--        <input type="hidden" name=rand(1000,9999)> HASLO-->

        <input type="submit" value="POTWIERDZ">
    </form>

</fieldset>

<?php

?>