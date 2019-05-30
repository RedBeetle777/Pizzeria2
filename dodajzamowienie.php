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
<?php
$rozmiarlistyN = count($_SESSION['listazamowieniaN']);
$rozmiarlistyP = count($_SESSION['listazamowieniaP']);
if(isset($_GET['rodzaj'])){
    $rodzaj = $_GET['rodzaj'];
    $rozmiar = $_GET['rozmiar'];
    array_push($_SESSION['listazamowieniaP'], $rodzaj + $rozmiar);
    header('Location: dodajzamowienie.php');
    exit();

}
if(isset($_GET['napoj'])){
    $napoj = $_GET['napoj'];
    array_push($_SESSION['listazamowieniaN'], $napoj);
    //print_r($_SESSION['listazamowieniaN']);
    header('Location: dodajzamowienie.php');
    exit();

}
?>
<?php
    require_once "connect.php";
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno;
    }
    else {
    }

    $listaPizz = @$polaczenie->query(
            sprintf("SELECT * FROM pizze"));

    ?>
<form action="kelner.php">
    <button type="submit">
        Wróć i porzuć zmiany!
    </button>

</form>
Wybierz Pizze:
<!--tutaj sektor dodawania pizzy do zamowienia-->
<?php
echo "<form action='dodajzamowienie.php'><select name= 'rodzaj'>";
while($rzad = $listaPizz->fetch_assoc()){
        if($rzad['rozmiar'] == "mala") {
            echo "<option value='" . $rzad["idPizza"] .
                "'> " . $rzad["NazwaPizzy"] . "</option>";

        }
    }
    echo "</select>";
echo "<br/>";
echo "<input type='radio' name='rozmiar' value='0' checked> mala";
echo "<input type='radio' name='rozmiar' value='1' > srednia";
echo "<input type='radio' name='rozmiar' value='2' > duza";
echo "<br/>";
echo "<input type='submit' value='Dodaj Pizze!'>";
echo "</form>";
?>

<!--tutaj dodawane sa napoje-->
Wybierz Napoje:
<?php
$listaNapoi = @$polaczenie->query(
    sprintf("SELECT * FROM napoje"));
echo "<form action='dodajzamowienie.php'><select name= 'napoj'>";
while($rzad = $listaNapoi->fetch_assoc()){
    echo "<option value='" . $rzad["idNapoj"] .
        "'> " . $rzad["NazwaNapoju"] ." ".$rzad["Pojemnosc"]."L"."</option>";
}
echo "</select>";
echo "<br/>";
echo "<input type='submit' value='Dodaj Napoj!'>";
echo "</form>";
?>

<br/>
Forma płatności:
<form action = dobazydanych.php>
    <input type="radio" name="platnosc" value="gotowka">gotówka
    <input type="radio" name="platnosc" value="karta">karta
<br/>
    <input type = 'submit' value="Dodaj zamowienie!">
<br/>

<?php
// wyswietlenie listy zamowien
echo "Aktualne zamówienie[Pizze]: dlugosc( ". $rozmiarlistyP.") ";
//print_r($_SESSION['listazamowieniaP']);
echo "<br/>";

for($i = 0; $i < $rozmiarlistyP; $i++) {
    $rezultat = @$polaczenie->query(
        sprintf("SELECT * FROM pizze WHERE idPizza='%s'",
            mysqli_real_escape_string($polaczenie,$_SESSION['listazamowieniaP'][$i])));
    $nazwapizzy = $rezultat->fetch_assoc();
    echo "ID PIZZY :".$_SESSION['listazamowieniaP'][$i].
        " || NAZWA PIZZY: ".$nazwapizzy['NazwaPizzy'].
        " || ROZMIAR: ".$nazwapizzy['rozmiar']." ||  Ilość: ";
    echo"<select name = ilPizz".$i.">"; //dodanie wyboru ilosci pizz
    for($j = 1; $j<10;$j++){
        echo "<option value= '$j'>".$j."</option>";
    }
    echo "</select>";
    //echo ""
//    echo "<"
    echo "<br/>";
}
echo "<br/>";
echo "Aktualne zamówienie[Napoje]: dlugosc( ". $rozmiarlistyN.")";
//print_r($_SESSION['listazamowieniaN']);
echo "<br/>";

for($i = 0; $i < $rozmiarlistyN; $i++) {
    echo$_SESSION['listazamowieniaN'][$i];
    echo "<br/>";
    $rezultat = @$polaczenie->query(
        sprintf("SELECT * FROM napoje WHERE idNapoj='%s'",
            mysqli_real_escape_string($polaczenie,$_SESSION['listazamowieniaN'][$i])));
    $nazwanapoju = $rezultat->fetch_assoc();
    echo "ID NAPOJU :".$_SESSION['listazamowieniaN'][$i].
        " || NAZWA NAPOJU: ".$nazwanapoju['NazwaNapoju'].
        " || POJEMNOSC: ".$nazwanapoju['Pojemnosc']." ||  Ilość: ";
    echo"<select name = ilNapo".$i.">"; //dodanie wyboru ilosci pizz
    for($j = 1; $j<10;$j++){
        echo "<option value= '$j'>".$j."</option>";
    }
    echo "</select>";
    echo "<br/>";
}
$polaczenie->close();
?>
</form>
<br/>
