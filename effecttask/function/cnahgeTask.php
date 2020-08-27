<?php
    //Изменение текста запсии в базе данных

    include_once('../dataBaseConfig.php');

    $id = $_POST['getChangeId'];
    $value = $_POST['getNewTaskText'];
    $queryChange = "UPDATE `task` SET `text`='$value' WHERE id = '$id'";
    mysqli_query($link, $queryChange) or die ('Error_Change_Item'.mysqli_error($link));
    echo('Новый текст задачи');
?>