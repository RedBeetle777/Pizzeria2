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
//sprawdzenie imienia
$blad = false;
if(isset($_GET['imie'])){
    if (strlen($_GET['imie']) == 0){
        $blad = true;
        echo "nie podano imienia!<br/>";
    }else array_push($dane, $_GET['imie']);
}else $blad = true;
//sprawdzenie nazwiska
if(isset($_GET['nazwisko'])){
    if (strlen($_GET['nazwisko']) == 0){
        $blad = true;
        echo "nie podano nazwiska!";
    }else array_push($dane, $_GET['nazwisko']);
}else $blad = true;
//jesli nie popelniono bledu
if (!$blad){
    array_push($dane, substr($_GET['imie'],0,strlen($_GET['imie'])).
        substr($_GET['nazwisko'],0,strlen($_GET['nazwisko'])));

    echo "login: ".$dane[2]." haslo: ".rand(1000,9999);
$sql = "INSERT INTO `uzytkownik` (`idUzytkownik`, `haslo`,
 `imie`, `nazwisko`, `login`, `stanowisko`)
  VALUES (NULL, '', '', '', '', 'Inne')";
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
        <input type="text" name="imie" > :IMIE<br/><br/>
        <input type="text" name="nazwisko" > :NAZWISKO<br/><br/>
        <select name="stanowisko">
            <option value="" selected></option>
            <option value="Manager">MANAGER</option>
            <option value="Kelner">KELNER</option>
            <option value="Kucharz">KUCHARZ</option>
            <option value="Inne">INNE</option>
        </select>
        STANOWISKO<br/><br/>
        <input type="submit" value="POTWIERDZ">
    </form>

</fieldset>

<?php

?>