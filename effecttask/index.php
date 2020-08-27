<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <style> @import url('./css/construct.css'); </style>
        <script src="./js/JQuery.js"></script>
        <title>Задачник</title>
    </head>
    <body>
        <!--Шапка сайта-->
        <nav class="navbar navbar-dark navbar-expand-lg bg-danger">
            <div class="navbar-brand">
                Задачник "Эффект"
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button id="authorizationButton" class="btn btn-outline-light menu-button" data-toggle="modal" data-target="#viewModal">Авторизация</button>
                </li>
                <li>
                    <button id="registrationButton" class=" btn btn-outline-light menu-button" data-toggle="modal" data-target="#viewModal">Регистрация</button>
                </li>
            </ul>
        </nav>
        
        <!--Форма для создания новой задачи-->
        <div class="center">
            <form method="POST">
                <div class="form-grid form-group">
                    <input type="text" id="name" class="form-control name-input-block" maxlength="25" placeholder="Имя пользователя">
                    <input type="email" id="email" class="form-control" maxlength="25" placeholder="E-mail">
                    <div class="input-group mb-3 task-input-block">
                        <input type="text" id="task" class="form-control" maxlength="50" placeholder="Текст задачи" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button id="createTaskButton" class="btn btn-outline-warning" type="button">Создать</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><hr class="container pt-1">

        <!--Контейнер для динамического добавления списка задач-->
        <div id="list" class="container pt-1"> Loading ... </div>
        
        <!--Модальное окно для внесения изменения в текст задачи-->
        <div class="modal fade" id="changeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Изменение задачи</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="form-group">
                                <input type="text" id="changeTaskText" class="form-control" placeholder="Новый текст задачи">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="modalClouseButton" type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
                        <button id="changeButton" type="button" class="btn btn-outline-success">Сохранить изменения</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Модальное окно для регистрации и авторизации пользователя в системе-->
        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div id="change-view" class="modal-content">
                </div>
            </div>
        </div>


        <script type="text/javascript">
            var key = false; //Ключ доступа к изменению и удалению записей из БД пользователем
            
            //Загрузка листа задач при входе на страницу
            $(document).ready(()=>{ 
                upDateList(); 
            })

            //Функция обновления списка задач на странице сайта
            function upDateList() {
                $.ajax({
                    url: './function/updateList.php',
                    success:(data)=>{
                        document.getElementById('list').innerHTML = "";
                        $('#list').html(data);
                    }
                });
            };

            //Создание нвоой запси
            $('#createTaskButton').click(()=>{
                $.ajax({
                    url:'./function/createTask.php',
                    method:'POST',
                    data:{
                        getName:document.getElementById('name').value,
                        getEmail:document.getElementById('email').value,
                        getTask:document.getElementById('task').value 
                    }
                }).done((data)=>{ console.log(data); });
                setInterval(()=>{ upDateList(); }, 1000);
                $('input').val('').change();
            });

            var changeIndex; //Идентификатор изменяемой позиции в списке
            //Изменение текста выбранной запси в списке
            $('#changeButton').click(() =>{
                if (key){
                    $.ajax({
                        url:'./function/cnahgeTask.php',
                        method:'POST',
                        data:{
                            getNewTaskText:document.getElementById('changeTaskText').value,
                            getChangeId:changeIndex
                        }
                    }).done((data)=>{ console.log(data); });
                    setTimeout(() => { $('#modalClouseButton').trigger('click'); }, 1000);
                    upDateList();
                }
                else{
                    alert('Вы не в системе');
                }
            });
            
            $('#authorizationButton').click(()=>{ changeModalView('aut');}); //Открытие модального окна авторизации 
            $('#registrationButton').click(()=>{ changeModalView('reg'); }); //Открытие модального окна регистрации

            var selectUrl; //Селектор viwe модального окна
            //Функция изменения view модального окна
            function changeModalView(index){
                if(index === 'aut') { selectUrl = './view/authorization.php'; }
                else if (index === 'reg') { selectUrl = './view/registration.php';}
                $.ajax({
                    url:selectUrl,
                    success:(data)=>{
                        document.getElementById('change-view').innerHTML = "";
                        $('#change-view').html(data);
                    }
                });
            }
        </script>
    </body>
</html>