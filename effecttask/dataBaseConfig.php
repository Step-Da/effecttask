<?php
    //Строка подключения к базе данных

    $host = 'localhost';
    $user = 'root';
    $password = 'root';
    $dataBaseName = 'task_database';
    $link = mysqli_connect($host, $user, $password, $dataBaseName) or die("Error".mysqli_error($link));
?>