<!DOCTYPE HTML>
<html>
<head>
    <title>Simple To-Do List</title>
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>
<div class="wrap">
    <div class="task-list">
        <ul>

        </ul>
    </div>
    <form class="add-new-task" autocomplete="off">
        <input type="text" name="new-task" placeholder="Add a new item..." />
    </form>
</div><!-- #wrap -->
</body>
<!-- JavaScript Files Go Here -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
    createContent();
    add_task(); // Call the add_task function
    delete_task(); // Call the delete_task function

    function createContent(){
        var $ul = $('.task-list ul');

        $.post('http://127.0.0.1/todo-list/api/read', function( data ) {
            if(data.success){
                data.data.forEach( function(element){
                    var new_li = '<li> <span>'+element.task+'</span> <img id="'+element.id+'" class="delete-button" width="10px" src="resources/images/close.svg"> </li>';
                    $(new_li).appendTo('.task-list ul').hide().fadeIn();
                });
            }
        });
    }

    function add_task() {

        $('.add-new-task').submit(function(){

            var new_task = $('.add-new-task input[name=new-task]').val();

            if(new_task != ''){

                $.post('http://127.0.0.1/todo-list/api/add', { task: new_task }, function( data ) {

                    console.log(data);

                    $('.add-new-task input[name=new-task]').val('');

                    var new_li = '<li> <span>'+data.data.task+'</span> <img id="'+data.data.id+'" class="delete-button" width="10px" src="resources/images/close.svg"> </li>';

                    $(new_li).appendTo('.task-list ul').hide().fadeIn();

                });
            }

            return false; // Ensure that the form does not submit twice
        });
    }

    function delete_task() {

        $('body').on( 'click', '.delete-button', function(){

            var current_element = $(this);

            var id = $(this).attr('id');

            $.post('http://127.0.0.1/todo-list/api/delete', { id: id }, function(data) {

                if(data.success){
                    current_element.parent().fadeOut("fast", function() { $(this).remove(); });

                }
            });
        });
    }

</script>

</html>
