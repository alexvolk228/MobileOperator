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
$abId = filter_var(trim($_POST['id']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}

$res = mysqli_query($connection, "DELETE FROM Абонент WHERE UserID = '$abId'");
$res = mysqli_query($connection, "DELETE FROM Номер WHERE UserID = '$abId'");

$check1 = mysqli_query($connection, "SELECT * FROM Абонент WHERE UserID = '$abId'");
$check2 = mysqli_query($connection, "SELECT * FROM Номер WHERE UserID = '$abId'");

if ($check1->num_rows == 0 && $check2->num_rows == 0) {
    echo '<p style = "color: rgb(109, 199, 20);">Абонент успешно удалён.</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу со всеми абонентами.</p>';
    header('Refresh: 2; url = /allAbon.php');
} else {
    echo '<p style = "color: red;">Произошла ошибка!</p>';
    echo ' <p>Через 2 сек мы перенаправим вас на страницу со всеми абонентами.</p>';
    header('Refresh: 2; url = /allAbon.php');
}
mysqli_close($connection);

?>