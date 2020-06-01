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
$idAb = filter_var(trim($_POST['id']),
FILTER_SANITIZE_STRING);


$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}
$sotr_id = $_COOKIE['SotrCallID'];

$res = mysqli_query($connection, "INSERT INTO Обслуживание VALUES ('$sotr_id', '$idAb', NOW())");

$check = mysqli_query($connection, "SELECT * FROM Обслуживание WHERE ID_Sotr = '$sotr_id' AND UserID = '$idAb'");

if ($check->num_rows != 0) {
    echo '<p style = "color: rgb(109, 199, 20);">Заявка успешно создана.</p>';
        echo ' <p>Через 2 сек мы перенаправим вас на страницу со списком заявок.</p>';
        header('Refresh: 2; url = /request.php');
}
else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу создания заявки.</p>';
    header('Refresh: 2; url = /creaReq.php');
}

mysqli_close($connection);

?>