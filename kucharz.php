<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	if ($_SESSION['stanowisko'] != 'Kucharz'){
		header('Location: przekierowanie.php');
		exit();
		
	}
require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
if(isset($_GET['usunid']) && (strlen($_GET['usunid'])>0)){
    $sql = "DELETE from zamowienie where idZamowienie =".$_GET['usunid'];
    if($polaczenie->query($sql) === TRUE){
        header('Location: kucharz.php');
    }

}
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
	echo "Jesteś:".$_SESSION['stanowisko'];

?>

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
            ", czas złożenia zamowienia: ".$rzad['CzasZamowienia']."<br/><br/>";
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

                echo "NAZWA PIZZY:".$rzad3['NazwaPizzy']." ".
                    $rzad3['rozmiar'].
                    "| ILOSC: ".$rzad2['Ilosc']."<br/>";
                //echo $listaskladnikow."<br/>";
            }
        }else echo "Brak zamowionych pizz w tym zamowieniu!<br/>";
        echo "<form action='kucharz.php'>".
            "<input type='hidden' name='usunid' value=".$rzad['idZamowienie'].">".
            "<input type='submit' value='ZAMOWIENIE ZREALIZOWANE'>".
            "</form><br/>";
    }

}else echo "brak zamowien"

?>

</body>
</html>

<!--//Pobranie skladnikow pizzy-->
<!--//                $sql = "SELECT idSkladnik from listaskladnikow-->
<!--//                        where idPizza = ".$rzad2['idPizzy'];-->
<!--//                $rezultat4 = $polaczenie->query($sql);-->
<!--//                if($rezultat4->num_rows>0){-->
<!--//                    $listaskladnikow = "";-->
<!--//                    while ($rzad4 = $rezultat4->fetch_assoc()){-->
<!--//                        $sql = "SELECT * from skladniki-->
<!--//                                    where idSkladniki = ".$rzad4['idSkladnik'];-->
<!--//                        $rezultat5 = $polaczenie->query($sql);-->
<!--//                        if ($rezultat5->num_rows > 0){-->
<!--//                            $index = 0;-->
<!--//                            while ($rzad5 = $rezultat5->fetch_assoc()){-->
<!--//                                $index ++;-->
<!--//                                $listaskladnikow .= "Skladnik ".$index.".".-->
<!--//                                    " ".$rzad5['nazwa'].-->
<!--//                                    "| VEGE ".$rzad5['Vege'].-->
<!--//                                    "| Ostrosc ".$rzad5['Ostrosc']."-->
<!--//                                            ";-->
<!--//                            }-->
<!--//                        }-->
<!--//                    }-->
<!--//                }-->