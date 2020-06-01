<style>
p {
    font-family: 'Roboto', sans-serif;
    text-align: center;
}
p:first-child {
    margin-top: 50px;
}

</style>
<?php
$num = filter_var(trim($_POST['number']),
FILTER_SANITIZE_STRING);
$usl = filter_var(trim($_POST['usl']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}


$res = mysqli_query($connection, "DELETE FROM УслугиНомера WHERE НомерТел = '$num' AND НазваниеУслуги = '$usl'");

$check = mysqli_query($connection, "SELECT * FROM УслугиНомера WHERE НомерТел = '$num' AND НазваниеУслуги = '$usl'");

if ($check->num_rows == 0 && $num != "" && $usl != "") {
    echo '<p style = "color: rgb(109, 199, 20);">Услуга успешно отключена.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас в личный кабинет.</p>';
    header('Refresh: 2; url = /per.php');
}
else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу отключения услуг.</p>';
    header('Refresh: 2; url = /disUsl.php');
}
mysqli_close($connection);

?>