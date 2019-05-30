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
    require_once "connect.php";
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno;
    }
//	Tworzenie(badz reset) listy zamowienia pizz
	if(isset($_SESSION['listazamowieniaP']))
	    unset($_SESSION['listazamowieniaP']);
	if(!isset($_SESSION['listazamowieniaP']))
	    $_SESSION['listazamowieniaP'] = array();
//	Tworzenie(badz reset) listy zamowienia Napoi
    if(isset($_SESSION['listazamowieniaN']))
        unset($_SESSION['listazamowieniaN']);
    if(!isset($_SESSION['listazamowieniaN']))
        $_SESSION['listazamowieniaN'] = array();

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Pizzeria</title>
</head>

<body>
	
<?php

	echo "<p>Witaj ".$_SESSION['imie'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';

?>
<form action="dodajzamowienie.php">

    <button type="submit">
        Dodaj zamowienie!
    </button>

</form>
<input type="button" value="Kliknij tutaj" onclick="window.alert('sssss')">
<br/><br/>
======Zamowienia======<br/>

<?php
$listazamowienID = array();
$sql = "SELECT * FROM zamowienie  \n"."ORDER BY zamowienie.CzasZamowienia  DESC";
    $rezultat = $polaczenie->query($sql);
    if($rezultat->num_rows > 0){
        while($rzad = $rezultat->fetch_assoc()){
            //wyswietlanie dodanych zamowien
            echo"=================================<br/>";
            echo "|ID zamowienia:".$rzad['idZamowienie'].
                ", czas złożenia zamowienia: ".$rzad['CzasZamowienia']."<br/>";
            $sql = "SELECT idPizzy, Ilosc FROM listapizz 
                where idZamowienie = ".$rzad['idZamowienie'];
            $rezultat2 = $polaczenie->query($sql);
            //wyswietlanie poszczegolnych pizz w zamowieniu
            if ($rezultat2 ->num_rows > 0){
                while ($rzad2=$rezultat2->fetch_assoc()) {
                    echo "ID PIZZY:".$rzad2['idPizzy'].
                        " ILOSC: ".$rzad2['Ilosc']."<br/>";
//                    ======= pobranie skladnikow pizzy=====
//                for ($i = 0; i<$rezultat->num_rows; $i++){
//
//                    ======= pobranie skladnikow pizzy=====
//                    $sql = "SELECT idSkladnik FROM listaskladnikow
//                        where idPizza =".$rezultat2['idPizzy'];
//                    $listaskladnikow = array();
//                    $rezultat3 = $polaczenie->query($sql);
//                    //zorbienie listy skladnikow do pizzy
//                    if ($rezultat3->num_rows > 0){
//                        while($rzad2 = $rezultat3->fetch_assoc()){
//                            array_push($listaskladnikow, )
//
//                        }
//                    }
//                }
//                    ======= pobranie skladnikow pizzy=====
                }
            }else echo "brak zamowionych pizz w tym zamowieniu!<br/>";
        }

    }else echo "brak zamowien"

?>

</body>
</html>
