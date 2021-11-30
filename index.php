<?php require 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>To Do List</title>
</head>
<body>
    <div class="main-section">
        <div class="add-section">
            <form action="app/add.php" method="POST" autocomplete="off">
                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                    <input type="text" name="title" style="border-color: red" placeholder="Champs obligatoire">
                    <button type="submit"> Add New Task</button>
                <?php }else { ?>
                    <input type="text" name="title" placeholder="Quel tache on va faire ">
                    <button type="submit"> Add New Task</button>
                <?php  } ?>
            </form>
        </div>

        <?php  $todos = $connexion->query("SELECT * FROM faire ORDER BY id DESC"); ?>

        <div class="show-todo-section">
            <?php if($todos->rowCount() > 0) { ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/f.png" width="100%">
                        <img src="img/Ellipsis.gif" width="80px ">
                    </div>
                </div>
            <?php } ?>

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="todo-item">
                <span id="<?php echo $todo['id']; ?>" class="remove-to-do"> X </span>
                <?php if($todo['checked']) { ?>
                    <input type="checkbox" class="check-box" data-todo-id ="<?php echo $todo['id']; ?>" checked />
                    <h2 class="checked"><?php echo $todo['title']; ?></h2>

                <?php } else { ?>
                    <input type="checkbox" data-todo-id ="<?php echo $todo['id']; ?>"  class="check-box"/>
                    <h2><?php echo $todo['title']; ?></h2>
                <?php } ?>
                <br>
                <small> created : <?php echo $todo['date_time']; ?></small>
            </div>
            <?php } ?>
        </div>
    </div>

    <script src="Js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');

                $.post("app/supp.php",
                    {
                        id: id
                    },
                    (data)  => {
                        if(data){
                            $(this).parent().hide(600);
                        }
                    }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');

                $.post('app/check.php',
                    {
                        id: id
                    },
                    (data) => {
                        if(data != 'error'){
                            const h2 = $(this).next();
                            if(data === '1'){
                                h2.removeClass('checked');
                            }else {
                                h2.addClass('checked');
                            }
                        }
                    }
                );
            });
        });
    </script>
</body>
</html>
