<?php
    //Получения списка всех пользователей ресурса и процесс аутентификация
    include_once('../dataBaseConfig.php');
    
    $getLogin = $_POST['getLogin'];
    $getPassword = $_POST['getPassword'];
    $querySelect = "SELECT `login`, `password` FROM user";
    $resultSelect = mysqli_query($link, $querySelect) or die ("Error_Select_User".mysqli_error($link));
    for($arrayUser = []; $item = mysqli_fetch_assoc($resultSelect); $arrayUser[] = $item);
    foreach($arrayUser as $element){
        if(($element['login'] == $getLogin) && ($element['password'] == $getPassword)){
            echo (true);
            exit();
        }
        else{
            echo('Пользователя в системе нет');
        }
    }
?>