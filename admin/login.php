<?php
header("Content-Type: text/html; charset=utf-8");
include $_SERVER['DOCUMENT_ROOT']."/db_config.php";	


if (isset ($_GET['login'])) {$loginDB = $_GET['login'];unset($loginDB);}
if (isset ($_GET['pass'])) {$pass = $_GET['pass'];unset($pass);}

//заносим в отдельные переменные логин и пароль присланных с помощью post запроса
if (isset ($_POST['login'])) {$loginDB = $_POST['login'];}
if (isset ($_POST['pass'])) {$passDB = $_POST['pass'];}
if(isset($loginDB) AND isset($passDB))//если существуют логин и пароль
{	
    if(preg_match("/^[a-zA-Z0-9_-]+$/s",$loginDB) AND preg_match("/^[a-zA-Z0-9]+$/s",$passDB))//проверяем их на корректность ввода с помощью регулярных выражений
    {
     
;
     //  echo $passDB;
            $passDB = md5($passDB);//шифруем введенный пароль
          //echo $passDB;
            //$resultlp = mysql_query("SELECT login,pass FROM admin WHERE login='admin'") or die(mysql_error());
			//$log_and_pass= mysql_fetch_array($resultlp)|| die(mysql_error()); 
             
			 $result = mysql_query("SELECT login,pass FROM admin WHERE login='admin'") or die(mysql_error());
             $log_and_pass = mysql_fetch_array($result);
		//echo $log_and_pass['pass'];
			
            if($log_and_pass != "")//если был выведен результат из БД
            {
			
			//echo "привет".$log_and_pass["login"];
                if($loginDB == $log_and_pass['login'] AND $passDB == $log_and_pass['pass'])//если введенная информация совпадает с информацией из БД
                {
                    session_start();//стартуем сессию
      				$_SESSION['$logSESS'] = $log_and_pass['login'];//создаем глобальную переменную
      				header("location: add_theory.php");//переносим пользователя на главную страницу
      				exit;				
                }
                else//если введеная инфо не совпадает с инфо из БД
                {
                    echo "Неправльный логин или пароль";
                    exit; 				
                }
            }
            else//если не найдено такого юзера в БД
            {
			     echo "Неправльный логин";
                header("location: login.php");//переносим на форму авторизации
                exit;
            }
        
    }
    else//если введены не корректный логин и пароль
    {
	     echo "Введен некорректный логин и пароль";
        exit; 
    }	
}

?>