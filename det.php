<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Расходы</title>
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
           if ($_COOKIE['user'] == '' && $_COOKIE['SotrCall'] == ''):
            ?>
            <li><a href="per.php" title="Вход" class = "login-link">Вход</a></li>
            <?php else: ?>
                <li><a href="per.php" title="Личный кабинет" class = "login-link">Личный кабинет</a></li>
                <li><a href="server/exit.php">Выход</a></li>
        <?php endif;?>
        </ul>
    </nav>
    </header>
    <main class="content">
        
        
        <?php if ($_COOKIE['SotrCall']): ?>
            <h2>Поиск расходов по номеру</h2>
        <div class = "search-num-det">
        <form action="" method = "post">
        <p class = "field">
        <label for="numb">Номер телефона: </label>
        <input class = "numb" id = "numb" name = "numb" type="text" placeholder = "8 (***) ***-**-**" style = "font-size: 15px;">
    </p>
    <button class = "btn-pay" type = "submit">Найти</button>
    </form>
    </div>
    <?php endif;?>
        
        <section class = "detail">
        <?php if ($_COOKIE['SotrCall']): ?>
        <h2>Расходы</h2> 
        <?php else: ?>
        <h2>Ваши расходы</h2> 
        <?php endif;?>
            <div class = "detail-block">
            <?php if ($_POST['numb']) : ?>
            <table>
            
            <tr><th>Номер телефона</th><th>Сумма расхода</th><th>Вид расхода</th><th>Дата/Время</th></tr>
            <?php 

        $connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
        if ($connection == false) {
            echo 'Не удалось подключиться к БД';
            echo my_sql_connect_error();
            exit();
        }

        ?>

            <?php 
            $us_id = filter_var(trim($_COOKIE['UsID']),
            FILTER_SANITIZE_STRING);
            $num = filter_var(trim($_POST['numb']),
            FILTER_SANITIZE_STRING);
            $number = mysqli_query($connection, "SELECT * FROM Расход WHERE НомерТел = '$num' ORDER BY ДатаВремя DESC");
            while ($det = mysqli_fetch_assoc($number)) {
                echo '<tr><td>' . $det['НомерТел'] . '</td><td>' . $det['СуммаРасхода'] . '</td>'
                . '<td>' . $det['ВидРасхода'] . '</td>' . '<td>' . $det['ДатаВремя'] . '</td></tr>';
            }
           
            ?>
            </table>
            <?php else: ?>
        <table>
            
        <tr><th>Номер телефона</th><th>Сумма расхода</th><th>Вид расхода</th><th>Дата/Время</th></tr>
        
        <?php
        $connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
        if ($connection == false) {
            echo 'Не удалось подключиться к БД';
            echo my_sql_connect_error();
            exit();
        }
        
        $us_id = filter_var(trim($_COOKIE['UsID']),
        FILTER_SANITIZE_STRING);
        $sql = mysqli_query($connection, "SELECT * FROM Расход WHERE НомерТел IN (SELECT НомерТел FROM Номер WHERE UserID = '$us_id') ORDER BY ДатаВремя DESC");
        while ($det = mysqli_fetch_assoc($sql)) {
            echo '<tr><td>' . $det['НомерТел'] . '</td><td>' . $det['СуммаРасхода'] . '</td>'
            . '<td>' . $det['ВидРасхода'] . '</td>' . '<td>' . $det['ДатаВремя'] . '</td></tr>';
        }
       
        mysqli_close($connection);
    
        ?>
        </table>
        <?php endif;?>
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