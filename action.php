<?php
//В обработчике принимаем данные из массива $_POST
$nameComment =  $_POST['name'];
$textComment = $_POST['text'];
//Соединяемся с базой данных
$host = 'localhost';
$user = 'root';
$password = '';
$dbName = 'gb';
$db = mysqli_connect($host, $user, $password, $dbName);
//Сохраняем с помощью запроса INSERT данные о новом комментарии
//Выполняем запрос SQL
$insert = "INSERT INTO `comment` (`id`, `name`, `text`) VALUES (NULL, '$nameComment', '$textComment')";
//Выполняет запрос к базе данных
$res_insert = mysqli_query($db, $insert);
//Переадресацию на главную страницу
if ($res_insert){
      header('Location: index.php');
};
?>