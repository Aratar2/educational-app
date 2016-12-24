<?php
header("Content-Type: text/html; charset=utf-8");
require_once "auth_validation.php";
?>
<html>
<head>
    <title>Редактирование теста</title>
    <style>
        #width_td{
            width:120px;
            word-wrap:break-word;
            text-align:center;
        }
    </style>

    <link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
    <link rel="stylesheet" type="text/css" href="/css/style.css"> <!--pemanggilan file css-->
</head>

<body>
<div id="header">
    <div class="inHeader">
        <div class="mosAdmin">
            Администратор<br>
            <a href="config.php">Настройки</a> | <a href="logout.php">Выйти</a>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div id="wrapper">
    <div id="leftBar">
        <ul>
            <li><a href="add_theory.php">Добавить тему</a></li>
            <li><a href="all_theory.php">Добавленные темы</a></li>
            <li><a href="tests.php">Тесты</a></li>
            <li><a href="stat_tests.php">Статистика по тестам</a></li>
        </ul>
    </div>
    <div id="rightContent">
        <h3>Редактирование теста</h3>

        <form action= "update_test.php" method= "POST">

        <?php

if(isset($_POST['edit'])&& !empty($_POST['edit'])) {
    $kod=$_POST['edit'];
    require_once $_SERVER['DOCUMENT_ROOT'] . "/db_config.php";


    $res=mysql_query("SELECT `name`,`count_qwestion`,`pid` FROM `tests_general` WHERE `pid`='$kod'")or die(mysql_error());
    $rowname = mysql_fetch_array($res);

    echo "<br>";

    echo "<h2>";
    echo "Название: ";
    echo "<input type='text' name=\"name\" value='".$rowname['name']."'>";
    echo"</h2>";

    echo "<input type='hidden' name=\"count_qwestion\" value='".$rowname['count_qwestion']."'>";
    echo "<input type='hidden' name=\"kod\" value='".$rowname['pid']."'>";



    $result=mysql_query("SELECT * FROM `test` WHERE `pid`='$kod'")or die(mysql_error());

    ////Просмотр записи

    echo "<br>";
    echo "<table>";

    echo "<tr class=\"data\">";

//////////
    echo "<th class=\"data\" align=\"center\" >";
    echo "№";
    echo "</th>";
//////////
    echo "<th class=\"data\"  align=\"center\" >";
    echo "Вопрос";
    echo "</th>";
//////////
    echo "<th class=\"data\"  align=\"center\" >";
    echo "Правильный ответ";
    echo "</th>";
//////////
    echo "<th class=\"data\" align=\"center\" >";
    echo "Вариант ответа";
    echo "</th>";
///////////
    echo "<th class=\"data\" align=\"center\" >";
    echo "Вариант ответа";
    echo "</th>";
///////////
    echo "<th class=\"data\" align=\"center\" >";
    echo "Вариант ответа";
    echo "</th>";
///////////


    $i=1;
    echo "</tr>";
    while ($row = mysql_fetch_array($result)) {


        echo "<tr class=\"data\">";

        echo "<td class=\"data\" align=\"center\">";
        echo $i;
        echo "</td>";

        echo "<td class=\"data\" align=\"center\">";
        echo "<div id=\"width_td\">";
        echo "<textarea name='question".$i."'>".$row["question"]."</textarea>";
        echo "</div>";
        echo "</td>";

        echo "<td class=\"data\" align=\"center\">";
        echo "<div id=\"width_td\">";
        echo "<textarea name='answer1".$i."'>".$row["answer1"]."</textarea>";
        echo "</div>";
        echo "</td>";

        echo "<td class=\"data\" align=\"center\">";
        echo "<div id=\"width_td\">";
        echo "<textarea name='answer2".$i."'>".$row["answer2"]."</textarea>";
        echo "</div>";
        echo "</td>";

        echo "<td class=\"data\" align=\"center\">";
        echo "<div id=\"width_td\">";
        echo "<textarea name='answer3".$i."'>".$row["answer3"]."</textarea>";
        echo "</div>";
        echo "</td>";

        echo "<td class=\"data\" align=\"center\">";
        echo "<div id=\"width_td\">";
        echo "<textarea name='answer4".$i."'>".$row["answer4"]."</textarea>";
        echo "</div>";
        echo "</td>";

        echo "</tr>";
        $i=$i+1;
    }


    echo "</table>";
}
        ?>
            <center>
            <br>
            <input type= "submit" class="button" name="edit_test" value= "Сохранить">
            </center>
        </form>

    </div>
    <div class="clear"></div>
    <div id="footer">
        &copy; 2016
    </div>
</div>
</body>
</html>