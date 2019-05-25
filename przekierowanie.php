<?php
	session_start();
	
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


?>
