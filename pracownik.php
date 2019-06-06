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
$sql = "SELECT * FROM uzytkownik where idUzytkownik = ".$_GET['id'];
$rezultat = $polaczenie->query($sql);
if($rezultat->num_rows > 0){
    $pracownik = $rezultat->fetch_assoc();
    $id = $pracownik['idUzytkownik'];
}else header('Location: pracownicy.php');
if(isset($_GET['imie']) && !(strlen($_GET['imie'])==0)) {
//    echo "zmiana imienia "
    $imie = $_GET['imie'];
    $sql = "UPDATE `uzytkownik` SET `imie` ='$imie'
    WHERE `uzytkownik`.`idUzytkownik` =$id";
    if($polaczenie->query($sql) === TRUE) {
        header('Location: pracownik.php?id=' . $pracownik['idUzytkownik']);
    }else echo "blad przy probie zmiany imienia";
}
//else echo "brak zmiany imienia";
if(isset($_GET['nazwisko']) && !(strlen($_GET['nazwisko'])==0)){
//    echo"zmiana nazwiska ";
    $nazwisko = $_GET['nazwisko'];
    $sql = "UPDATE `uzytkownik` SET `nazwisko` ='$nazwisko'
    WHERE `uzytkownik`.`idUzytkownik` =$id";
    if($polaczenie->query($sql) === TRUE) {
        header('Location: pracownik.php?id=' . $pracownik['idUzytkownik']);
    }else echo "blad przy probie zmiany imienia";
}
//else echo "brak zmiany nazwiska";
if(isset($_GET['login']) && !(strlen($_GET['login'])==0)){
//    echo"zmiana loginu ";
    $login = $_GET['login'];
    $sql = "UPDATE `uzytkownik` SET `login` ='$login'
WHERE `uzytkownik`.`idUzytkownik` =$id";
    if($polaczenie->query($sql) === TRUE) {
        header('Location: pracownik.php?id=' . $pracownik['idUzytkownik']);
    }else echo "blad przy probie zmiany imienia";}
//else echo "brak zmiany loginu";
if(isset($_GET['stanowisko']) && !(strlen($_GET['stanowisko'])==0)){
//    echo"zmiana stanowiska ";
    $stanowisko = $_GET['stanowisko'];
    $sql = "UPDATE `uzytkownik` SET `stanowisko` ='$stanowisko'
WHERE `uzytkownik`.`idUzytkownik` =$id";
    if($polaczenie->query($sql) === TRUE) {
        header('Location: pracownik.php?id=' . $pracownik['idUzytkownik']);
    }else echo "blad przy probie zmiany imienia";}
//else echo "brak zmiany stanowiska";
if(isset($_GET['haslo']) && !(strlen($_GET['haslo'])==0)) {
//    echo "zmiana imienia "
    $haslo = $_GET['haslo'];
    $sql = "UPDATE `uzytkownik` SET `haslo` ='$haslo'
    WHERE `uzytkownik`.`idUzytkownik` =$id";
    if($polaczenie->query($sql) === TRUE) {
        header('Location: pracownik.php?id=' . $pracownik['idUzytkownik']);
    }else echo "blad przy probie zmiany hasla";
}
//else echo "brak zmiany imienia";
?>
    <form action="pracownicy.php">

        <button type="submit">
            POWRÓT
        </button>

    </form>
KARTA PRACOWNIKA <br/><br/>
IMIE:
<?php
echo $pracownik['imie'];
?>
<form action="pracownik.php">
    <?php
        echo "<input type='hidden' name='id' value='".
            $pracownik['idUzytkownik']."'>";
    ?>
    <input type="text" name="imie">
    <input type="submit" value="ZMIEN">
</form>
<br/>
NAZWISKO:
<?php
echo $pracownik['nazwisko'];
?>
<form action="pracownik.php">
    <?php
    echo "<input type='hidden' name='id' value='".
        $pracownik['idUzytkownik']."'>";
    ?>
    <input type="text" name="nazwisko">
    <input type="submit" value="ZMIEN">
</form>
<br/>
LOGIN:
<?php
echo $pracownik['login'];
?>
<form action="pracownik.php">
    <?php
    echo "<input type='hidden' name='id' value='".
        $pracownik['idUzytkownik']."'>";
    ?>
    <input type="text" name="login">
    <input type="submit" value="ZMIEN">
</form>
<br/>
STANOWISKO:
<?php
echo $pracownik['stanowisko'];
?>
<form action="pracownik.php">
    <?php
    echo "<input type='hidden' name='id' value='".
        $pracownik['idUzytkownik']."'>";
    ?>
    <select name="stanowisko">
        <option value="" selected></option>
        <option value="Manager">MANAGER</option>
        <option value="Kelner">KELNER</option>
        <option value="Kucharz">KUCHARZ</option>
        <option value="Inne">INNE</option>
    </select>
    <input type="submit" value="ZMIEN">
</form>
<br/>
HASLO:
<?php
echo "<form action=\"pracownik.php\">";
if(isset($_GET['pokahaslo']) && ($_GET['pokahaslo'] =='ODKRYJ'))
    echo "<input type='text' name='' value='".$pracownik['haslo']."'>";
else echo "HASLO UKRYTE!";
echo "</form>";
?>
<form action="pracownik.php">
    <?php
    echo "<input type='hidden' name='id' value='".
        $pracownik['idUzytkownik']."'>";
    ?>
    <input type="submit" name="pokahaslo" value="ODKRYJ">
    <input type="submit" name="pokahaslo" value="UKRYJ">
</form>
<form action="pracownik.php">
    <?php
    echo "<input type='hidden' name='id' value='".
        $pracownik['idUzytkownik']."'>";
    ?>
    <input type="text" name="haslo">
    <input type="submit" value="ZMIEN">
</form>
