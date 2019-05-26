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

</body>
</html>
