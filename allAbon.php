<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Все абоненты</title>
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
    <main class="content all-users-list">
        
        <section class = "detail">
        <h2>Все абоненты</h2> 
            <div class = "detail-block tab">
            <form action = "" method = "post" style = "margin-bottom: -20px;">
            <p>
            <label for="us-search">Поиск абонента:</label>
            <input type="text" class= "us-search" id = "us-search" placeholder = "Фамилия Имя Отчество/ID"  name = "abon" autofocus>
            </p>
            <p>
            <button type = "submit" >Найти</button>
            </p>
            </form >
            <?php if (!$_POST['abon']): ?>
            <div style = "display:flex; justify-content:space-around;margin-bottom: -20px;">
            <form action = "" method = "post" >
            <p>
            <input type="text" class= "visually-hidden" value = "asc" name = "sortAlp">
            </p>
            <p>
            <button type = "submit">Сортировка по алфавиту (А->Я)</button>
            </p>
            </form>
            <form action = "" method = "post" >
            <p>
            <input type="text" class= "visually-hidden" value = "desc" name = "sortAlp">
            </p>
            <p>
            <button type = "submit">Сортировка по алфавиту (Я->А)</button>
            </p>
            </form>
            <form action = "" method = "post">
            <p>
            <input type="text" class= "visually-hidden" value = "Minus" name = "Minus">
            </p>
            <p>
            <button type = "submit">Баланс < 0</button>
            </p>
            </form>
            </div>
            <?php endif;?>
            <?php if ($_POST['abon'] || $_POST['sortAlp'] || $_POST['Minus']): ?>
            <form action = "/allAbon.php" method = "post" style = "margin-top: 30px;">
            <p>
            <button type = "submit">Отмена</button>
            </p>
            </form>
            <?php endif;?>
        </div>
            
        
        <?php 

        $connection = mysqli_connect('localhost', 'root', 'root', 'VolkTelecom');
            
        if ($connection == false) {
            echo 'Не удалось подключиться к БД';
            echo my_sql_connect_error();
            exit();
        }

        if ($_POST['sortAlp']) {
            
            ?>
            <div class = "tab-block">
            <table class = "allAbTab">
            
            <?php
            if ($_POST['sortAlp'] == "asc") {
            $sql = mysqli_query($connection, "SELECT * FROM Абонент ORDER BY ФИО ASC");
            }
            else {
                $sql = mysqli_query($connection, "SELECT * FROM Абонент ORDER BY ФИО DESC");
            }
            if ($sql->num_rows != 0) {
                echo '<tr><th>ID Абонента</th><th>ФИО</th><th>Серия паспорта</th><th>Номер паспорта</th><th>Номер телефона</th><th>Баланс</th><th>Тариф</th><th>Услуги</th></tr>';
            }
            while ($req = mysqli_fetch_assoc($sql)) {
                $usId = $req['UserID'];
                $sqlCo = mysqli_query($connection, "SELECT COUNT(*) AS CNT FROM Номер WHERE UserID = '$usId'");
                $resCo = mysqli_fetch_assoc($sqlCo);
                $rowNums = $resCo['CNT'];

                echo '<tr><td rowspan = " '. $rowNums .'">' . $req['UserID'] . '</td><td rowspan = " '. $rowNums .'">' . $req['ФИО'] . '</td>'
            . '<td rowspan = " '. $rowNums .'">' . $req['СерияПаспорта'] . '</td>' 
            . '<td rowspan = " '. $rowNums .'">' . $req['НомерПаспорта'] . '</td>';
            
            
            $sql1 = mysqli_query($connection, "SELECT * FROM Номер WHERE UserID = '$usId'");
            
            while ($rez = mysqli_fetch_assoc($sql1)) {
                echo '<td>' . $rez['НомерТел'] . '</td>';
                echo '<td>' . $rez['Баланс'] . '</td>';
                $usNumb = $rez['НомерТел'];
                $tarId = $rez['НомТарифа'];
                $sql2 = mysqli_query($connection, "SELECT НазваниеТарифа FROM Тариф WHERE НомТарифа = '$tarId'");
                $rez1 = mysqli_fetch_assoc($sql2);
                echo '<td>' . $rez1['НазваниеТарифа'] . '</td>';

                $sql3 = mysqli_query($connection, "SELECT НазваниеУслуги FROM УслугиНомера WHERE НомерТел = '$usNumb'");
                while (($rez2 = mysqli_fetch_assoc($sql3))) {
                    echo '<td>' . $rez2['НазваниеУслуги'] . '</td>';
                }
                echo '</tr>';
            }
            echo '</tr>';
        }
            ?>
            </table>
            </div>
            
            <?php 
            mysqli_close($connection);
            } 
            else if ($_POST['Minus'] == "Minus") {
            
                ?>
                <div class = "tab-block">
                <table class = "allAbTab">
                
                <?php
                $sql = mysqli_query($connection, "SELECT * FROM Абонент WHERE UserID IN (SELECT UserID FROM Номер WHERE Баланс < 0)");
                
                if ($sql->num_rows != 0) {
                    echo '<tr><th>ID Абонента</th><th>ФИО</th><th>Серия паспорта</th><th>Номер паспорта</th><th>Номер телефона</th><th>Баланс</th><th>Тариф</th><th>Услуги</th></tr>';
                }
                while ($req = mysqli_fetch_assoc($sql)) {
                    $usId = $req['UserID'];
                    $sqlCo = mysqli_query($connection, "SELECT COUNT(*) AS CNT FROM Номер WHERE UserID = '$usId'");
                    $resCo = mysqli_fetch_assoc($sqlCo);
                    $rowNums = $resCo['CNT'];
    
                    echo '<tr><td rowspan = " '. $rowNums .'">' . $req['UserID'] . '</td><td rowspan = " '. $rowNums .'">' . $req['ФИО'] . '</td>'
                . '<td rowspan = " '. $rowNums .'">' . $req['СерияПаспорта'] . '</td>' 
                . '<td rowspan = " '. $rowNums .'">' . $req['НомерПаспорта'] . '</td>';
                
                
                $sql1 = mysqli_query($connection, "SELECT * FROM Номер WHERE UserID = '$usId' AND Баланс < 0");
                
                while ($rez = mysqli_fetch_assoc($sql1)) {
                    echo '<td>' . $rez['НомерТел'] . '</td>';
                    echo '<td>' . $rez['Баланс'] . '</td>';
                    $usNumb = $rez['НомерТел'];
                    $tarId = $rez['НомТарифа'];
                    $sql2 = mysqli_query($connection, "SELECT НазваниеТарифа FROM Тариф WHERE НомТарифа = '$tarId'");
                    $rez1 = mysqli_fetch_assoc($sql2);
                    echo '<td>' . $rez1['НазваниеТарифа'] . '</td>';
    
                    $sql3 = mysqli_query($connection, "SELECT НазваниеУслуги FROM УслугиНомера WHERE НомерТел = '$usNumb'");
                    while (($rez2 = mysqli_fetch_assoc($sql3))) {
                        echo '<td>' . $rez2['НазваниеУслуги'] . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</tr>';
            }
                ?>
                </table>
                </div>
                
                <?php 
                mysqli_close($connection);
                } 

        else if ($_POST['abon']) {
            $abon = filter_var(trim($_POST['abon']),
            FILTER_SANITIZE_STRING);
            
            ?>
            <div class = "tab-block">
            <table class = "allAbTab">
            
            <?php
            if (is_numeric($abon)) {
                $sql = mysqli_query($connection, "SELECT * FROM Абонент WHERE UserID LIKE '$abon%'");
            } else {
                $sql = mysqli_query($connection, "SELECT * FROM Абонент WHERE ФИО LIKE '$abon%'");
            }
            if ($sql->num_rows != 0) {
                echo '<tr><th>ID Абонента</th><th>ФИО</th><th>Серия паспорта</th><th>Номер паспорта</th><th>Номер телефона</th><th>Баланс</th><th>Тариф</th><th>Услуги</th></tr>';
            }
            while ($req = mysqli_fetch_assoc($sql)) {
                $usId = $req['UserID'];
                $sqlCo = mysqli_query($connection, "SELECT COUNT(*) AS CNT FROM Номер WHERE UserID = '$usId'");
                $resCo = mysqli_fetch_assoc($sqlCo);
                $rowNums = $resCo['CNT'];

                echo '<tr><td rowspan = " '. $rowNums .'">' . $req['UserID'] . '</td><td rowspan = " '. $rowNums .'">' . $req['ФИО'] . '</td>'
            . '<td rowspan = " '. $rowNums .'">' . $req['СерияПаспорта'] . '</td>' 
            . '<td rowspan = " '. $rowNums .'">' . $req['НомерПаспорта'] . '</td>';
            
            
            $sql1 = mysqli_query($connection, "SELECT * FROM Номер WHERE UserID = '$usId'");
            
            while ($rez = mysqli_fetch_assoc($sql1)) {
                echo '<td>' . $rez['НомерТел'] . '</td>';
                echo '<td>' . $rez['Баланс'] . '</td>';
                $usNumb = $rez['НомерТел'];
                $tarId = $rez['НомТарифа'];
                $sql2 = mysqli_query($connection, "SELECT НазваниеТарифа FROM Тариф WHERE НомТарифа = '$tarId'");
                $rez1 = mysqli_fetch_assoc($sql2);
                echo '<td>' . $rez1['НазваниеТарифа'] . '</td>';

                $sql3 = mysqli_query($connection, "SELECT НазваниеУслуги FROM УслугиНомера WHERE НомерТел = '$usNumb'");
                while (($rez2 = mysqli_fetch_assoc($sql3))) {
                    echo '<td>' . $rez2['НазваниеУслуги'] . '</td>';
                }
                echo '</tr>';
            }
            echo '</tr>';
        }
            ?>
            </table>
            </div>
            <?php if (!$_COOKIE['SotrCall']): ?>
             <?php
           if ($sql->num_rows != 0):
            ?>
            <div class = "delAb">
            <h3>Удаление абонента</h3>
            <div class = "drop-ab">
            <form class = "drop-form" action="server/delAb.php" method = "post">
            <p class = "field">
            <label for="id">Номер абонента: </label>
            <select class = "id" id = "id" name = "id" type="text">
            <?php 
                if (is_numeric($abon)) {
                    $abId = mysqli_query($connection, "SELECT UserID FROM Абонент WHERE UserID LIKE '$abon%'");
                } else {
                    $abId = mysqli_query($connection, "SELECT UserID FROM Абонент WHERE ФИО LIKE '$abon%'");
                }
                while ($drop = mysqli_fetch_assoc($abId)) {
                    echo '<option>' . $drop['UserID'] . '</option>';
                }

                ?>
                </select>
            </p>
            <p>
            <button class = "btn-ins" type = "submit">Удалить</button>
            </p>
            </form>
            
            <?php endif;?>
            <?php endif;?>
            <?php 
            mysqli_close($connection);
            } else {
            ?>
        <?php
        $sql = mysqli_query($connection, "SELECT * FROM Абонент");
        ?>
            <div class = "tab-block">
            <table class = "allAbTab">
    
            <tr><th>ID Абонента</th><th>ФИО</th><th>Серия паспорта</th><th>Номер паспорта</th><th>Номер телефона</th><th>Баланс</th><th>Тариф</th><th>Услуги</th></tr>
            <?php
        while ($req = mysqli_fetch_assoc($sql)) {
        $usId = $req['UserID'];
        $sqlCo = mysqli_query($connection, "SELECT COUNT(*) AS CNT FROM Номер WHERE UserID = '$usId'");
        $resCo = mysqli_fetch_assoc($sqlCo);
        $rowNums = $resCo['CNT'];

            echo '<tr><td rowspan = " '. $rowNums .'">' . $req['UserID'] . '</td><td rowspan = " '. $rowNums .'">' . $req['ФИО'] . '</td>'
            . '<td rowspan = " '. $rowNums .'">' . $req['СерияПаспорта'] . '</td>' 
            . '<td rowspan = " '. $rowNums .'">' . $req['НомерПаспорта'] . '</td>';
            
            $sql1 = mysqli_query($connection, "SELECT * FROM Номер WHERE UserID = '$usId'");
            
            while ($res = mysqli_fetch_assoc($sql1)) {
                echo '<td>' . $res['НомерТел'] . '</td>';
                echo '<td>' . $res['Баланс'] . '</td>';
                $usNumb = $res['НомерТел'];
                $tarId = $res['НомТарифа'];
                $sql2 = mysqli_query($connection, "SELECT НазваниеТарифа FROM Тариф WHERE НомТарифа = '$tarId'");
                $res1 = mysqli_fetch_assoc($sql2);
                echo '<td>' . $res1['НазваниеТарифа'] . '</td>';

                $sql3 = mysqli_query($connection, "SELECT НазваниеУслуги FROM УслугиНомера WHERE НомерТел = '$usNumb'");
                while ($res2 = mysqli_fetch_assoc($sql3)) {
                    echo '<td>' . $res2['НазваниеУслуги'] . '</td>';
                }
                echo '</tr>';
            }
            echo '</tr>';
        }
        ?>
        </table>
        <?php
        mysqli_close($connection);
    }
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