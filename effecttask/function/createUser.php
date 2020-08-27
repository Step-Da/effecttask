<?php
    //Создание новго пользователя в базе данных 

    include_once('../dataBaseConfig.php');
    
    $data = [$_POST['setLogin'], $_POST['setPassword']];
    $query = "INSERT INTO user (`login`, `password`) VALUE('$data[0]', '$data[1]')";
    mysqli_query($link, $query) or die('Error_Create_User'.mysqli_error($link));
    echo('Пользователь создан');
?>