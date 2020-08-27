<?php
    echo('
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="POST">
            <div class="form-group">
                <input type="text" id="getLogin" class="form-control margin-input-modal" placeholder="Логин">
            </div>
            <div class="form-group">
                <input type="password" id="getPassword" class="form-control margin-input-modal" placeholder="Пароль">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button id="clouseQuitAut" type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
        <button id="siginButton" type="button" class="btn btn-outline-success">Вход</button>
    </div>');
?>
<script>
    //Авторизация пользователя в системе веб-ресурса
    $('#siginButton').click(function(){
        $.ajax({
            url:'./function/authorizationUser.php',
            method:'POST',
            data:{
                getLogin:document.getElementById('getLogin').value,
                getPassword:document.getElementById('getPassword').value
            }
        }).done((data)=>{ 
            if(data == true){ key = true; }
            else{ key = false; }
            console.log(key);
        });
        setTimeout(() => { $('#clouseQuitAut').trigger('click'); }, 1000);
    });
</script>