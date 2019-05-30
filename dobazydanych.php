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
$rozmiarlistyN = count($_SESSION['listazamowieniaN']);
$rozmiarlistyP = count($_SESSION['listazamowieniaP']);
//=============================================================
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Pobranie sposobu zaplaty
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_GET['platnosc'])){
    $sposobzap = $_GET['platnosc'];
    echo "wybrany sposob zaplaty to: ".$sposobzap;
}else
    echo "nie wybrano sposobu zaplaty!";
//=============================================================
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Polaczenie sie z baza danych
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
//=============================================================
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//pobranie id kelnera
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$rezultat = @$polaczenie->query(
    sprintf("SELECT * FROM kelner WHERE idUzytkownika='%s'",
        mysqli_real_escape_string($polaczenie,$_SESSION['idUzytkownik'])));
$wiersz = $rezultat ->fetch_assoc();
$idkelnera = $wiersz['idKelner'];
echo "Id uzytkownika wynosi: ".$_SESSION['idUzytkownik']." || id kelnera wynosi:".$idkelnera;
//=============================================================
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//dodanie nowego zamowienia do bazy danych oraz przechwycenie jego id
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$sql = "INSERT INTO `zamowienie` (`idKelnera`, `idKucharza`, `KwotaZamowienia`,
    `SposobZaplaty`, `PotwierdzenieZaplaty`)
    VALUES ('$idkelnera', '2', NULL, '$sposobzap', NULL)";
if ($polaczenie->query($sql) === TRUE){
    $idZamowienia = $polaczenie->insert_id;
    echo "dodano zamowienie o ID: ".$idZamowienia;
}
else echo "Error: " . $sql . "<br>" . $polaczenie->error;
//=============================================================
$kwota = 0;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//dodanie do listy pizz(dla zamowienia w bazie)
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
echo "<br/><br/>";
for($i = 0;$i < $rozmiarlistyP; $i++){
    $idPizzy = $_SESSION['listazamowieniaP'][$i];
    $ilosc = $_GET['ilPizz'.$i];
    if($ilosc === 0) continue;
    $sql = "SELECT koszt FROM pizze WHERE idPizza=$idPizzy";
    $rezultat = $polaczenie->query($sql);
    if($rezultat->num_rows > 0){
        $rzad = $rezultat -> fetch_assoc();
        $koszt = $rzad['koszt'];
        $kwota += $koszt * $ilosc;
    }

    $sql = "INSERT INTO `listapizz` (`idZamowienie`, `idPizzy`, `Ilosc`)
 VALUES ('$idZamowienia', '$idPizzy', '$ilosc')";
    if ($polaczenie->query($sql) === TRUE){
        $idlistypizz = $polaczenie->insert_id;
        //echo "dodano zamowienie o ID: ".$idlistypizz;
    }
    else echo "Error: " . $sql . "<br>" . $polaczenie->error;
}
//=============================================================
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//dodanie do listy Napojow(dla zamowienia w bazie)
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
echo "<br/><br/>";
for($i = 0;$i < $rozmiarlistyN; $i++){
    $idNapoju = $_SESSION['listazamowieniaN'][$i];
    $ilosc = $_GET['ilNapo'.$i];
    if($ilosc === 0) continue;
    $sql = "SELECT Cena FROM napoje WHERE idNapoj=$idNapoju";
    $rezultat = $polaczenie->query($sql);
    if($rezultat->num_rows > 0){
        $rzad = $rezultat -> fetch_assoc();
        $koszt = $rzad['Cena'];
        $kwota += $koszt * $ilosc;
    }
    $sql = "INSERT INTO `listanapojow` (`idZamowienie`, `idNapoj`, `ilosc`)
 VALUES ('$idZamowienia', '$idNapoju', '$ilosc')";
    if ($polaczenie->query($sql) === TRUE){
        $idlistynapojow = $polaczenie->insert_id;
        //echo "dodano zamowienie o ID: ".$idlistynapojow;
    }
    else echo "Error: " . $sql . "<br>" . $polaczenie->error;
}
//=============================================================
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//policzenie ostatecznego kosztu oraz aktualizacja zamowienia w bazie D
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$sql = "UPDATE `zamowienie` SET `KwotaZamowienia` = '$kwota'
    WHERE `zamowienie`.`idZamowienie` = '$idZamowienia'";
//if(
    $polaczenie->query($sql);
    //=== TRUE)
    //echo "Zmodyfikowano cene: {".$kwota."} pomyslnie";
//else echo "nie zmodyfikowano ceny!";
//=============================================================
header('Location: przekierowanie.php');
exit();

?>
