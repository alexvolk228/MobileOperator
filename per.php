<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Личный кабинет</title>
    <link href ="css/style.css" rel="stylesheet"> 
</head>
<body>
<header class="main-header">
        <nav class="main-nav">
        <ul class="main-nav-list">
            <li><a href="index.php" title="На главную">VolkTelecom</a></li>
            <li><a href="tar.php"title= "Тарифы">Тарифы</a></li>
            <li><a href="usl.php" title="Услуги">Услуги</a></li>
            <?php
             if ($_COOKIE['user'] == '' && $_COOKIE['sotr'] == '' && $_COOKIE['SotrCall'] == ''):
            ?>
            <li><a href="#" title="Вход" class = "login-link">Вход</a></li>
            <?php else: ?>
                <li><a href="#" title="Личный кабинет" class = "login-link">Личный кабинет</a></li>
                <li><a href="server/exit.php">Выход</a></li>
        <?php endif;?>
        </ul>
    </nav>
    </header>
            <main class = "personal">
            <?php
            if ($_COOKIE['user']):
            ?>
            <section class="user-info">
                <div class = "ab-info">
            <p >Здравствуйте, <?=str_replace(array("+"), array(" "), $_COOKIE['user'])?>!</p>
            
            <h3>Счёт</h3>
            <?php
            $connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
            if ($connection == false) {
                echo 'Не удалось подключиться к БД';
                echo my_sql_connect_error();
                exit();
}

            $us_id = filter_var(trim($_COOKIE['UsID']),
            FILTER_SANITIZE_STRING);
            $res = mysqli_query($connection, "SELECT * FROM Номер WHERE UserID = '$us_id'");
            while ($us = mysqli_fetch_assoc($res)) {
                $us_tar_num = $us['НомТарифа'];
                $tar = mysqli_query($connection, "SELECT * FROM Тариф WHERE НомТарифа = '$us_tar_num'");
                $num_tar = mysqli_fetch_assoc($tar);
                echo
                '<p>Ваш номер телефона: </p>'.
                '<p><span class = "green"> ' . $us['НомерТел'] . '</span></p>'.
                '<p>Тариф: <span class = "green">  '. $num_tar['НазваниеТарифа'] .'</span></p>'.
                '<p>Минуты: <span class = "green">  '. $num_tar['Минуты'] .'</span> мин</p>'.
                '<p>Интернет: <span class = "green">  '. $num_tar['Интернет'] .'</span> Гб</p>';
                if ($num_tar['Сообщения'] != null) {
                '<p>Сообщения: <span class = "green">  '. $num_tar['Сообщения'] .'</span> шт</p>';
                }
                echo '<p>Доступно на сегодня: </p>'.
                '<p><span class = "green">' . $us['Баланс'] . '</span> руб</p>
                ';
                
            $ptr = $us['НомерТел'];
            $sql = mysqli_query($connection, "SELECT * FROM УслугиНомера WHERE НомерТел = '$ptr'");
           
            $serv = mysqli_fetch_assoc($sql);
            if ($serv['НазваниеУслуги'] != null) {
                echo '<h3>Подключённые услуги</h3>';
            }
            $sql = mysqli_query($connection, "SELECT * FROM УслугиНомера WHERE НомерТел = '$ptr'");
            while ($ser = mysqli_fetch_assoc($sql)) {
                if ($ser['НазваниеУслуги'] != null) {
                echo '<p>' . $ser['НазваниеУслуги'] . '</p>';
            }
        }
        echo '<hr style = "width: 165px; float: left; margin-left: 10px"><br>';
            }
            
           ?>
           <?php
            mysqli_close($connection);
           ?>
           </div>
            <div class = "buttons">
            <a href = "adScore.php"><button class = "card-cab">Пополнить счёт</button></a>
            <a href = "tar.php"><button class = "card-cab">Сменить тариф</button></a>
            <a href = "usl.php"><button class = "card-cab">Подключить услуги</button></a>
            <a href = "det.php"><button class = "card-cab">Детализация</button></a>
            <a href = "disUsl.php"><button class = "card-cab">Отключить услуги</button></a>
            <a href = "newPass.php"><button class = "card-cab">Изменить пароль</button></a>
        </div>
        </section>
        <?php elseif ($_COOKIE['sotr']): ?>
            <section class="user-info sotr">
            <div class = "ab-info">
            <p >Здравствуйте, <?=str_replace(array("+"), array(" "), $_COOKIE['sotr'])?>!</p>
            <h3>Информация</h3>
            <?php
            $connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
            if ($connection == false) {
                echo 'Не удалось подключиться к БД';
                echo my_sql_connect_error();
                exit();
            }

            $sotr_id = filter_var(trim($_COOKIE['StID']),
            FILTER_SANITIZE_STRING);
            $res = mysqli_query($connection, "SELECT * FROM Сотрудник WHERE ID_Sotr = '$sotr_id'");
        
            $sotr = mysqli_fetch_assoc($res);
            echo '<p>Ваша должность: <span class = "green"> '. $sotr['Должность'] . '</span></p>';
            ?>
            <?php
            mysqli_close($connection);
           ?>
            </div>
            <div class = "buttons admin">
            <a href = "adUser.php"><button class = "card-cab">Зарегистрировать абонента</button></a>
            <a href = "adNum.php"><button class = "card-cab">Добавить абоненту номер</button></a>
            <a href = "adTar.php"><button class = "card-cab">Добавить тариф</button></a>
            <a href = "adUsl.php"><button class = "card-cab">Добавить услугу</button></a>
            <a href = "allAbon.php"><button class = "card-cab">Все абоненты/Удаление</button></a>
            <a href = "request.php"><button class = "card-cab">Заявки</button></a>
            <a href = "dropTar.php"><button class = "card-cab">Удалить тариф</button></a>
            <a href = "dropUsl.php"><button class = "card-cab">Удалить услугу</button></a>
            <a href = "regOrDelSotr.php"><button class = "card-cab">Зарегистрировать/Удалить сотрудника</button></a>
            <a href = "newPass.php"><button class = "card-cab">Изменить пароль</button></a>
        </div>
        <?php elseif ($_COOKIE['SotrCall']): ?>
            <section class="user-info sotr">
            <div class = "ab-info">
            <p >Здравствуйте, <?=str_replace(array("+"), array(" "), $_COOKIE['SotrCall'])?>!</p>
            <h3>Информация</h3>
            <?php
            $connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
            if ($connection == false) {
                echo 'Не удалось подключиться к БД';
                echo my_sql_connect_error();
                exit();
            }

            $sotr_id = filter_var(trim($_COOKIE['SotrCallID']),
            FILTER_SANITIZE_STRING);
            $res = mysqli_query($connection, "SELECT * FROM Сотрудник WHERE ID_Sotr = '$sotr_id'");
        
            $sotr = mysqli_fetch_assoc($res);
            echo '<p>Ваша должность: <span class = "green"> '. $sotr['Должность'] . '</span></p>';
            ?>
            <?php
            mysqli_close($connection);
           ?>
            </div>
            <div class = "buttons">
            <a href = "allAbon.php"><button class = "card-cab">Все абоненты</button></a>
            <a href = "request.php"><button class = "card-cab">Все Заявки</button></a>
            <a href = "creaReq.php"><button class = "card-cab">Создание Заявки</button></a>
            <a href = "det.php"><button class = "card-cab">Операции по номерам</button></a>
            <a href = "newPass.php"><button class = "card-cab">Изменить пароль</button></a>
        </div>
        <?php endif;?>
        </section>
        <footer class="main-footer">
        <div class="footer-content">
        <div class="social">
            <a href="http://vk.com" title="Группа ВК" target="_blank">
                <img src="img/vk.png" alt="ВК" width="30px" height="30px">
            </a>
            <a href="https://twitter.com" title="Твиттер"target="_blank">
            <img src="img/twit.png" alt="Твиттер" width="30px" height="30px">
            </a>
        </div>
        <div class="rights">
            Все права защищены &copy 2020
        </div>
    </div>
        </main>
    </footer>
</body>
</html>