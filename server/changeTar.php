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
$numTar = filter_var(trim($_POST['tar-id']),
FILTER_SANITIZE_STRING);
$numAb = filter_var(trim($_POST['number']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}
if ($numAb != "") {
$costSql = mysqli_query($connection, "SELECT СтоимостьТарифа FROM Тариф WHERE НомТарифа = '$numTar'");
$costRes = mysqli_fetch_assoc($costSql);
$costTar = $costRes['СтоимостьТарифа'];

$res = mysqli_query($connection, "UPDATE Номер SET НомТарифа = '$numTar', Баланс = Баланс - '$costTar'
WHERE НомерТел = '$numAb'");

$det = mysqli_query($connection, "INSERT INTO Расход (НомерТел, СуммаРасхода, ВидРасхода, ДатаВремя) 
VALUES ('$numAb', '$costTar', 'Оплата Тарифа', NOW())");

$sql = mysqli_query($connection, "SELECT НомТарифа FROM Номер WHERE НомерТел = '$numAb'");
$fetch = mysqli_fetch_assoc($sql);
$result = $fetch['НомТарифа'];
}

if ($numTar == $result) {
    echo '<p style = "color: rgb(109, 199, 20);">Тариф успешно изменён.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас в личный кабинет.</p>';
    header('Refresh: 2; url = /per.php');
}
else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу изменения тарифа.</p>';
    header('Refresh: 2; url = /tar.php');
}
mysqli_close($connection);

?>