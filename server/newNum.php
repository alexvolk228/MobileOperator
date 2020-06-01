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
$idAb = filter_var(trim($_POST['idAb']),
FILTER_SANITIZE_STRING);
$numb = filter_var(trim($_POST['numb']),
FILTER_SANITIZE_STRING);
$tarUser = filter_var(trim($_POST['tarUser']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}

$sql = mysqli_query($connection, "SELECT НомТарифа FROM Тариф WHERE НазваниеТарифа = '$tarUser'");
$fetch = mysqli_fetch_assoc($sql);
$tar = $fetch['НомТарифа'];

$res = mysqli_query($connection, "INSERT INTO Номер (НомерТел, UserID, НомТарифа)
VALUES ('$numb', '$idAb', '$tar')");

$check = mysqli_query($connection, "SELECT * FROM Номер WHERE НомерТел = '$numb'");

if ($check->num_rows != 0) {
    echo '<p style = "color: rgb(109, 199, 20);">Номер успешно добавлен.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас в личный кабинет.</p>';
    header('Refresh: 2; url = /per.php');
} else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы вернём вас на страницу добавления номера.</p>';
    header('Refresh: 2; url = /adNum.php');
}

mysqli_close($connection);

?>