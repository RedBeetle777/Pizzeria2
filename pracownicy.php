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
if(isset($_GET['kasujid']) && (strlen($_GET['kasujid'])>0)) {
    $kasowane_id = $_GET['kasujid'];
    echo "czy na pewno usunac pracownika " . $_GET['kasujid']."z bazy";
echo "<form action='pracownicy.php'>".
    "<input type='hidden' name='kasujid' value=".$kasowane_id.">".
    "<input type='submit' name='potwierdzenie' value='Tak'>".
    "<input type='submit' name='potwierdzenie' value='Nie'>".
    "</form>";
}
if(isset($_GET['potwierdzenie']) && ($_GET['potwierdzenie'] == "Tak")) echo "skasowane";
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
        echo "_______________________________________________________<br/>".
            "IMIĘ: ".$rzad['imie']." NAZWISKO: ".$rzad['nazwisko'].
            " STANOWISKO: ".$rzad['stanowisko'].
            "<form action='pracownik.php?'>".
            "<input type='hidden' name='id' value='".$rzad['idUzytkownik']."'>".
            "<input type='submit' value='EDYTUJ'>".
            "</form>".
            "<form action='pracownicy.php'>".
            "<input type='hidden' name='kasujid' value='".$rzad['idUzytkownik']."'>".
            "<input type='submit' value='USUN'>".
            "</form>".
            "_______________________________________________________".
            "<br/>";
    }

}
?>