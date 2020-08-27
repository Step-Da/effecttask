<?php
    //Динамическое обновление спсика задач на странице сайта

    include('../dataBaseConfig.php');

    $returnData = mysqli_query($link,"SELECT * FROM task") or die ("Error_Select_User".mysqli_error($link));
    for($selectItem = []; $item = mysqli_fetch_assoc($returnData); $selectItem[] = $item);
    foreach($selectItem as $element){
        echo(
         '<div class="container pt-1">
         <ul class="ist-group list">
             <li class="list-group-item list-item">
                 <div>
                    <strong>'.$element['text'].'</strong>
                    <small>'.$element['name'].'&nbsp;'.$element['email'].'</small> 
                 </div>
                 <div>
                    <button type="button" class="btn btn-outline-info btn-sm changeButton" data-toggle="modal" data-target="#changeModal" value='.$element['id'].' >&udarr;</button>
                    <button type="button" class="btn btn-outline-danger btn-sm deleteButton" value='.$element['id'].' btn-sm">&times;</button>
                 </div>
             </li>
         </ul>
        </div>');
    }
?>
<script>
    //Обнволение спсика после удаления записи
    $(".deleteButton").click(function(){
        deleteItem($(this).val());
        upDateList();
    });

    //Получение индекса выбранной строки
    $(".changeButton").click(function(){
        changeIndex = $(this).val();
    });

    //Удаление записи задачи из БД
    function deleteItem(id){
        if(key){
                $.ajax({
                url:'./function/deleteTask.php',
                method:'POST',
                data:{
                    getDeleteId:id
                }
            }).done((data)=>{ console.log(data); })
            upDateList();
        }
        else{
            alert('Вы не в системе');
        }
    }
</script>