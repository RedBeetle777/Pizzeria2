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

require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
//pobranie id kelnera
$rezultat = @$polaczenie->query(
    sprintf("SELECT * FROM kelner WHERE idUzytkownika='%s'",
        mysqli_real_escape_string($polaczenie,$_SESSION['idUzytkownik'])));
$wiersz = $rezultat ->fetch_assoc();
$idkelnera = $wiersz['idKelner'];
echo "Id uzytkownika wynosi: ".$_SESSION['idUzytkownik']." || id kelnera wynosi:".$idkelnera;
?>
