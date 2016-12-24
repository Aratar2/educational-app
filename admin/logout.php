<?php

session_start();
unset ($_SESSION['$logSESS']);//удаляем зарегистрированную глобальную переменную
session_destroy();//уничтожаем сессию
header("location: /admin/index.php");//перебрасываем на главную страницу пользовательской части блога
exit;

   
?>
 