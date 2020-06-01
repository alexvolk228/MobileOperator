<?php
$abon = filter_var(trim($_POST['abon']),
FILTER_SANITIZE_STRING);

$connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');

if ($connection == false) {
    echo 'Не удалось подключиться к БД';
    echo my_sql_connect_error();
    exit();
}

$sql = mysqli_query($connection, "SELECT * FROM Абонент WHERE ФИО = '$abon'");
while (($res = mysqli_fetch_assoc($sql))) {
    echo '<tr><td>' . $res['UserID'] . '</td><td>' . $res['ФИО'] . '</td>'
            . '<td>' . $res['СерияПаспорта'] . '</td>' 
            . '<td>' . $res['НомерПаспорта'] . '</td></tr>';
}

mysqli_close($connection);
?>