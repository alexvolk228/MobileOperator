<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация/удаление сотрудника</title>
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
    <main class="content">
        <section class = "new new-sotr">
        <h3>Регистрация сотрудника</h3>
        <form class = "tar-form" action="server/regSotr.php" method = "post">
        <p class = "field">
        <label for="name">ФИО сотрудника: </label>
        <input class = "name" id = "name" name = "name" type="text">
        </p>
        <p class = "field">
        <label for="dol">Должность: </label>
        <input class = "dol" id = "dol" type="text" name = "dol">
        </p>
        <p class = "field">
        <label for="dol">Пароль: </label>
        <input class = "pass" id = "pass" type="text" name = "pass">
        </p>
        <button class = "btn-ins" type = "submit">Добавить</button>
        </form>
        </section>

        <section class = "new del-sotr">
        <h3>Удаление сотрудника</h3>
        <form class = "tar-form" action="server/delSotr.php" method = "post">
        <p class = "field">
        <label for="id">ID сотрудника: </label>
        <select class = "id" name = "id" id = "id" type="text">
        <?php
             $connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
             if ($connection == false) {
                 echo 'Не удалось подключиться к БД';
                 echo my_sql_connect_error();
                 exit();
             }
            $id_admin = $_COOKIE['StID'];
            $sotr = mysqli_query($connection, "SELECT ID_Sotr FROM Сотрудник WHERE ID_Sotr <> '$id_admin'");

            while (($id = mysqli_fetch_assoc($sotr))) {
                echo '<option>' . $id['ID_Sotr'] . '</option>';
            }
            ?>
        </select>
        </p>
        <button class = "btn-ins" type = "submit">Удалить</button>
        </form>
        </section>
        
        <section class = "allSotr">
        <h3>Все сотрудники</h3>
        <div class = "tab-sotr-block">
            <table class = "allSotrTab">
    
            <tr><th>ID Сотрудника</th><th>ФИО</th><th>Должность</th></tr>
        <?php
        $sql = mysqli_query($connection, "SELECT * FROM Сотрудник");
        while (($req = mysqli_fetch_assoc($sql))) {
            echo '<tr><td>' . $req['ID_Sotr'] . '</td><td>' . $req['ФИОсотрудника'] . '</td>'
            . '<td>' . $req['Должность'] . '</td></tr>';
        }
        ?>
        </table>
        <?php
        mysqli_close($connection);
        ?>
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