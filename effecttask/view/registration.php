<?php
   echo('
   <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
       </button>
   </div>
   <div class="modal-body">
       <form method="POST">
           <div class="form-group">
               <input type="text" id="setLogin" class="form-control margin-input-modal" placeholder="Логин">
           </div>
           <div class="form-group">
               <input type="password" id="setPassword" class="form-control margin-input-modal" placeholder="Пароль">
           </div>
       </form>
   </div>
   <div class="modal-footer">
       <button id="clouseQuitReg" type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
       <button id="registrationButtonModal" type="button" class="btn btn-outline-success">Зарегистрироваться</button>
   </div>');
?>
<script>
    //Регистрация нвого пользователя в системе веб-ресурса
    $('#registrationButtonModal').click(function(){
        $.ajax({
            url:'../function/createUser.php',
            method: 'POST',
            data:{
                setLogin:document.getElementById('setLogin').value,
                setPassword:document.getElementById('setPassword').value
            }
        }).done((data)=>{ console.log(data) });
        setTimeout(()=>{ $('#clouseQuitReg').trigger('click'); }, 1000);
    });

</script>