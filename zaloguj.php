<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}
	

	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM uzytkownik WHERE login='%s' AND haslo='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$_SESSION['zalogowany'] = true;
                
				
				$wiersz = $rezultat->fetch_assoc();
				/*

				$_SESSION['user'] = $wiersz['user'];
				$_SESSION['drewno'] = $wiersz['drewno'];
				$_SESSION['kamien'] = $wiersz['kamien'];
				$_SESSION['zboze'] = $wiersz['zboze'];
				$_SESSION['email'] = $wiersz['email'];
				$_SESSION['dnipremium'] = $wiersz['dnipremium'];
				*/
				$_SESSION['idUzytkownik'] = $wiersz['idUzytkownik'];
				$_SESSION['imie'] = $wiersz['imie'];
				$_SESSION['stanowisko'] = $wiersz['stanowisko'];
				unset($_SESSION['blad']);
				$rezultat->free_result();
				//header('Location: Kelner.php');
				
				if($_SESSION['stanowisko'] == 'Kucharz'){
					header('Location: kucharz.php');
				}
				if($_SESSION['stanowisko'] == 'Kelner'){
					header('Location: kelner.php');
				}
				if($_SESSION['stanowisko'] == 'Manager'){
					header('Location: manager.php');
				}
				if($_SESSION['stanowisko'] == 'Inne'){
					header('Location: inne.php');
				}
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: index.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>
