Skip to content
Search or jump to…

Pull requests
Issues
Marketplace
Explore

@yarielg
Learn Git and GitHub without any code!
Using the Hello World guide, you’ll start a branch, write comments, and open a pull request.


mattlitzinger
/
Simple_AJAX_Todo_List
4
24
16
Code
Issues
Pull requests
Actions
Projects
Wiki
Security
Insights
Simple_AJAX_Todo_List/index.php /

Matt Litzinger Initial Commit
Latest commit 3c27158 on Mar 3, 2014
History
0 contributors
86 lines (61 sloc)  1.8 KB

Code navigation is available!
Navigate your code with ease. Click on function and method calls to jump to their definitions or references in the same repository. Learn more

<!DOCTYPE HTML>
<html>
<head>
    <title>Simple To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
    <div class="task-list">
        <ul>

            <?php
            require("includes/connect.php");

            $query = mysql_query("SELECT * FROM tasks ORDER BY date ASC, time ASC");
            $numrows = mysql_num_rows($query);

            if($numrows>0){
                while( $row = mysql_fetch_assoc( $query ) ){

                    $task_id = $row['id'];
                    $task_name = $row['task'];

                    echo '<li>
								<span>'.$task_name.'</span>
								<img id="'.$task_id.'" class="delete-button" width="10px" src="images/close.svg" />
							  </li>';
                }
            }

            ?>

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

    add_task(); // Call the add_task function
    delete_task(); // Call the delete_task function

    function add_task() {

        $('.add-new-task').submit(function(){

            var new_task = $('.add-new-task input[name=new-task]').val();

            if(new_task != ''){

                $.post('includes/add-task.php', { task: new_task }, function( data ) {

                    $('.add-new-task input[name=new-task]').val('');

                    $(data).appendTo('.task-list ul').hide().fadeIn();

                    delete_task();
                });
            }

            return false; // Ensure that the form does not submit twice
        });
    }

    function delete_task() {

        $('.delete-button').click(function(){

            var current_element = $(this);

            var id = $(this).attr('id');

            $.post('includes/delete-task.php', { task_id: id }, function() {

                current_element.parent().fadeOut("fast", function() { $(this).remove(); });
            });
        });
    }

</script>

</html>
