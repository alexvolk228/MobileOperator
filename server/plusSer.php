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
$namSer = filter_var(trim($_POST['ser-id']),
FILTER_SANITIZE_STRING);
$numAb = filter_var(trim($_POST['number']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}
$costSql = mysqli_query($connection, "SELECT СтоимостьУслуги FROM Услуга WHERE НазваниеУслуги = '$namSer'");
$costRes = mysqli_fetch_assoc($costSql);
$costUsl = $costRes['СтоимостьУслуги'];

if ($numAb != "") {
$res = mysqli_query($connection, "INSERT INTO УслугиНомера VALUES ('$numAb ', '$namSer')");
$res1 = mysqli_query($connection, "UPDATE Номер SET Баланс = Баланс - '$costUsl' WHERE НомерТел = '$numAb'");
$det = mysqli_query($connection, "INSERT INTO Расход (НомерТел, СуммаРасхода, ВидРасхода, ДатаВремя) 
VALUES ('$numAb', '$costUsl', 'Оплата Услуг', NOW())");
}
$check = mysqli_query($connection, "SELECT * FROM УслугиНомера WHERE НомерТел = '$numAb' AND НазваниеУслуги = '$namSer'");

if ($check->num_rows != 0) {
    echo '<p style = "color: rgb(109, 199, 20);">Услуга успешно добавлена.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас в личный кабинет.</p>';
    header('Refresh: 2; url = /per.php');
}
else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу добавления услуги.</p>';
    header('Refresh: 2; url = /usl.php');
}

mysqli_close($connection);

?>