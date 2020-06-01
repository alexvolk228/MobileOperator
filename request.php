<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Обслуживание</title>
    <link href ="css/style.css" rel="stylesheet"> 
</head>
<body>
<header class="main-header">
        <nav class="main-nav">
        <ul class="main-nav-list">
            <li><a href="index.php" title="На главную">VolkTelecom</a></li>
            <li><a href="tar.php"title= "Тарифы">Тарифы</a></li>
            <li><a href="usl.php" title="Услуги">Услуги</a></li>
            <li><a href="per.php" title="Личный кабинет" class = "login-link">Личный кабинет</a></li>
            <li><a href="server/exit.php">Выход</a></li>
        </ul>
    </nav>
    </header>
    <main class="content req-content">
        
        <?php 
        $connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
        if ($connection == false) {
            echo 'Не удалось подключиться к БД';
            echo my_sql_connect_error();
            exit();
        }
        ?>
        <section class = "detail">
        <h2>Обслуживание</h2> 
            <div class = "req-block">
            <div class = "tab-req-block">
        <table class = "reqTab"> 
            
        <tr><th>ID Сотрудника</th><th>ID Абонента</th><th>Дата заявки</th></tr>
        
        <?php 
        $sql = mysqli_query($connection, "SELECT * FROM Обслуживание ORDER BY ДатаЗаявки");
        while (($req = mysqli_fetch_assoc($sql))) {
            echo '<tr><td>' . $req['ID_Sotr'] . '</td><td>' . $req['UserID'] . '</td>'
            . '<td>' . $req['ДатаЗаявки'] . '</td></tr>';
        }

        mysqli_close($connection);
        
        ?>
        </table>
        </div>
        </div>
        </section>
    </main>
    <footer class="main-footer">
        <div class="footer-content">
        <div id="social">
            <a href="http://vk.com" title="Группа ВК" target="_blank">
                <img src="img/vk.png" alt="ВК" width="30px" height="30px">
            </a>
            <a href="https://twitter.com" title="Твиттер"target="_blank">
            <img src="img/twit.png" alt="Твиттер" width="30px" height="30px">
            </a>
        </div>
        <div id="rights">
            Все права защищены &copy 2020
        </div>
    </div>
    </footer>
</body>
</html>