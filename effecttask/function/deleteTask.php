<?php
    //Удаление записи задачи из базы данных
    include_once('../dataBaseConfig.php');

    $id = $_POST['getDeleteId'];
    $queryDelete = "DELETE FROM task WHERE `id` = '$id'";
    mysqli_query($link, $queryDelete) or die ('Error_Delete_Item'.mysqli_error($link));
    echo('Задача удалена');
?>