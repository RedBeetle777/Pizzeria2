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
	/*
	if($_SESSION['stanowisko'] == 'Manager'){
		echo "Manager";
	}
	if($_SESSION['stanowisko'] == 'Kelner'){
		echo "Kelner";
	}
	if($_SESSION['stanowisko'] == 'Kucharz'){
		echo "Kuc";
	}
	if($_SESSION['stanowisko'] == 'Inne'){
		echo "Inne";
	}
	*/
?>

</body>
</html>
