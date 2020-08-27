<?php
    //Создание новой запсии задания в базе данных 

    include_once('../dataBaseConfig.php');

    $data = [$_POST['getName'], $_POST['getEmail'], $_POST['getTask']];
    $query = "INSERT INTO task (`name`, `email`, `text`) VALUES ('$data[0]', '$data[1]', '$data[2]')";
    mysqli_query($link, $query) or die('Error_Create_Task'.mysqli_error($link));
    echo('Запись создана');
?>