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

<br/><br/>
======Zamowienia======<br/>

<?php

$listazamowienID = array();
$sql = "SELECT * FROM zamowienie  \n"."ORDER BY zamowienie.CzasZamowienia  DESC";
    $rezultat = $polaczenie->query($sql);
    if($rezultat->num_rows > 0){
        while($rzad = $rezultat->fetch_assoc()){
            $do_zaplaty = 0;
            //wyswietlanie dodanych zamowien
            echo"=================================<br/>";
            echo "|ID zamowienia:".$rzad['idZamowienie'].
                ", czas złożenia zamowienia: ".$rzad['CzasZamowienia']."<br/>SPOSOB ZAPLATY: ".
                $rzad['SposobZaplaty']." CZY OPLACONE: ".$rzad['PotwierdzenieZaplaty']."<br/><br/>";
            echo "ZAMOWIONE PIZZE:<br/>";
            $sql = "SELECT idPizzy, Ilosc FROM listapizz 
                where idZamowienie = ".$rzad['idZamowienie'];
            $rezultat2 = $polaczenie->query($sql);
            //wyswietlanie poszczegolnych pizz w zamowieniu
            if ($rezultat2 ->num_rows > 0){
                while ($rzad2=$rezultat2->fetch_assoc()) {
                    //dodanie listy skladnikow dla dane pizzy
//                    $listaskladnikow = array();
                    $sql = "SELECT NazwaPizzy, rozmiar, koszt FROM pizze
                        where idPizza = ".$rzad2['idPizzy'];
                    $rezultat3 = $polaczenie->query($sql);
                    $rzad3 = $rezultat3->fetch_assoc();
                    //Pobranie skladnikow pizzy
                    $sql = "SELECT idSkladnik from listaskladnikow
                        where idPizza = ".$rzad2['idPizzy'];
                    $rezultat4 = $polaczenie->query($sql);
                        if($rezultat4->num_rows>0){
                            $listaskladnikow = "";
                            while ($rzad4 = $rezultat4->fetch_assoc()){
                                $sql = "SELECT * from skladniki
                                    where idSkladniki = ".$rzad4['idSkladnik'];
                                $rezultat5 = $polaczenie->query($sql);
                                if ($rezultat5->num_rows > 0){
                                    $index = 0;
                                    while ($rzad5 = $rezultat5->fetch_assoc()){
                                        $index ++;
                                        $listaskladnikow .= "Skladnik ".$index.".".
                                            " ".$rzad5['nazwa'].
                                            "| VEGE ".$rzad5['Vege'].
                                            "| Ostrosc ".$rzad5['Ostrosc']."
                                            ";
                                    }
                                }
                            }
                        }
                    echo "NAZWA PIZZY:".$rzad3['NazwaPizzy']." ".
                        $rzad3['rozmiar'].
                        "| ILOSC: ".$rzad2['Ilosc']."| CENA: ".$rzad3['koszt'].
                        "ZL<br/>";
                        //echo $listaskladnikow."<br/>";
                    $do_zaplaty += $rzad2['Ilosc']*$rzad3['koszt'];
                }
            }else echo "Brak zamowionych pizz w tym zamowieniu!<br/>";
            echo "<br/>ZAMOWIONE NAPOJE:<br/>";
            $sql = "SELECT idNapoj, ilosc FROM listanapojow 
                where idZamowienie = ".$rzad['idZamowienie'];
            $rezultat2 = $polaczenie->query($sql);
            //wyswietlanie poszczegolnych napojow w zamowieniu
            if ($rezultat2 ->num_rows > 0){
                while ($rzad2=$rezultat2->fetch_assoc()) {
                    $sql = "SELECT NazwaNapoju, Pojemnosc, Cena FROM napoje
                        where idNapoj = ".$rzad2['idNapoj'];
                    $rezultat3 = $polaczenie->query($sql);
                    $rzad3 = $rezultat3->fetch_assoc();

                    echo "NAZWA NAPOJU:".$rzad3['NazwaNapoju']." ".
                        $rzad3['Pojemnosc']."L ".
                        "| ILOSC: ".$rzad2['ilosc']."| CENA: ".$rzad3['Cena'].
                        "ZL<br/>";
                    $do_zaplaty += $rzad2['ilosc']*$rzad3['Cena'];
                }
            }else echo "Brak zamowionych napojow w tym zamowieniu!<br/>";
            echo "KWOTA DO ZAPLATY: ".$do_zaplaty." ZL<br/>";
        }

    }else echo "brak zamowien"

?>

</body>
</html>
<!--https://www.w3schools.com/php/php_mysql_select.asp-->
