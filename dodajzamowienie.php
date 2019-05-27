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
    require_once "connect.php";
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($polaczenie->connect_errno!=0)
    {
        echo "Error: ".$polaczenie->connect_errno;
    }
    else {
//
//        if($listaPizz = @$polaczenie->query(
//            sprintf("SELECT * FROM pizze"))) {
//            if($listaPizz->num_rows > 0){
//
//                while($rzad = $listaPizz->fetch_assoc()){
//
//                    echo "Numer pizzy: ".$rzad["idPizza"].
//                        " Nazwa pizzy:".$rzad["NazwaPizzy"].
//                        " rozmiar: ".$rzad["rozmiar"].
//                        "<br>";
//                }
//            }
//            else{
//                echo "0 results";
//            }
//        }
    }

    $listaPizz = @$polaczenie->query(
            sprintf("SELECT * FROM pizze"));
    echo "<form><select>";
    //echo "<option value = '"0""
    while($rzad = $listaPizz->fetch_assoc()){
        echo "<option value='".$rzad["idPizza"].
            "'> ".$rzad["NazwaPizzy"]."</option>";
    }

    echo "</select></form>";
?>
<form action=""
<form action="kelner.php">
    <button type="submit">
        Wróć i porzuć zmiany!
    </button>

</form>
tutaj dodajemu zamoiwienie
