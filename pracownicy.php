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
?>

<form action="manager.php">

    <button type="submit">
        POWRÓT
    </button>

</form>
Lista pracowników:
<?php

?>