<?php
//В обработчике принимаем данные из массива $_POST
$nameComment =  $_POST['name'];
$textComment = $_POST['text'];
//проверка ввел ли пользователь данные
if ($nameComment == null and $textComment == null){
    header('Location: index.php');
}else{
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

if ($res_insert){
    session_start();
    $_SESSION{'name'} = $nameComment;
     header('Location: index.php');
};
};
?>