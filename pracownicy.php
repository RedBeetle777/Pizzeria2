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
require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
?>

<form action="manager.php">

    <button type="submit">
        POWRÓT
    </button>

</form><form action="dodajpracownika.php">

    <button type="submit">
        DODAJ PRACOWNIKA
    </button>

</form>
Lista pracowników:
<br/><br/>
<?php
$sql = "SELECT * FROM uzytkownik order by uzytkownik.stanowisko";
$rezultat = $polaczenie->query($sql);
if($rezultat->num_rows > 0){
    while($rzad = $rezultat->fetch_assoc()){
        echo "IMIĘ: ".$rzad['imie']." NAZWISKO: ".$rzad['nazwisko'].
            " STANOWISKO: ".$rzad['stanowisko'].
            "<form action='pracownik.php?'>".
            "<input type='hidden' name='id' value='".$rzad['idUzytkownik']."'>".
            "<input type='submit' value='EDYTUJ'>".
            "</form><br/>";

//".$rzad['idUzytkownik'].
//            "' value='EDYTUJ
    }

}
?>