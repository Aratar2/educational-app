<?php
header("Content-Type: text/html; charset=utf-8");
require_once "auth_validation.php";
?>
<html>
<head>
    <title>Отчет по тестированию</title>

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
        <h3>Отчет по тестированию</h3>


        <?php

if(isset($_POST['prev']) && !empty($_POST['prev'])) {

echo "<center><h2>".$_POST['name_student']."</h2> </center>";



    require_once $_SERVER['DOCUMENT_ROOT'] . "/db_config.php";
    $id =$_POST['prev'];

    $result = mysql_query("SELECT `str_result` FROM tests_result WHERE id='$id'") or die(mysql_error());
    $row_str=mysql_fetch_array($result);
    $str_result=$row_str['str_result'];
    //echo $str_result;
    $resultTest=json_decode($str_result,true) or json_last_error();
    $kod = $resultTest[0]['kod'];

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
    echo "<th class=\"data\"  align=\"center\" >";
    echo "Выбраный ответ";
    echo "</th>";
    //////////
	echo "<th class=\"data\"  align=\"center\" >";
    echo "";
    echo "</th>";
    //////////
    echo "</tr>";

    for($i=0; $i<count($resultTest); $i++){

        $question=$resultTest[$i]['question'];
        $resultEquals = mysql_query("SELECT `answer1` FROM `test` WHERE `question`='$question' AND `pid`='$kod'");
        $row=mysql_fetch_array($resultEquals);
		$check_str="";
        if($resultTest[$i]['selectedAnswer']==$row['answer1']){
		$check_str="/css/img/ok.png";
		}
		else{
		$check_str="/css/img/not.png";
		}
        echo "<tr class=\"data\">";

        echo "<td class=\"data\" align=\"center\">";
        echo $i+1;
        echo "</td>";

        echo "<td class=\"data\" align=\"center\">";
        echo $question;
        echo "</td>";

		echo "<td  class=\"data\" align=\"center\">";
        echo $row['answer1'];
        echo "</td>";
		
        echo "<td class=\"data\" align=\"center\">";
        echo $resultTest[$i]['selectedAnswer'];
        echo "</td>";

        
        echo "<td  class=\"data\" align=\"center\">";
		echo "<img  src=\"".$check_str."\" width=\"30px\"";
        echo "</td>";
		
        echo "</tr>";
		$check_str="";
    }


    echo "</table>";
}
        ?>

    </div>
    <div class="clear"></div>
    <div id="footer">
        <a href="https://vk.com/aratar2">Абдалиев Айрат </a> &copy; 2016
    </div>
</div>
</body>
</html>