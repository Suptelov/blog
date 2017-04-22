<?php

require_once("../database_connection.php");
require_once("../app_config.php");

?>
<head>
    <style>
        .container{
            display: flex;
            border: 1px solid black;
            flex-direction: row;
            padding: 5px;
            border-collapse: collapse;
            max-width: 600px;
        }
        .element{
            display: flex;
            flex-direction: column;
            padding:5px;
            padding-left: 20px;
        }
        .container:nth-child(odd){background-color: lightslategrey; color: white;}


    </style>

</head>

    <div class="main">
    <?php
        $counter=0;
        $query = "Select user_id, first_name, last_name, email From users";
        $result = mysqli_query($link, $query);
        $row_res = mysqli_fetch_row($result);

        while($arr=mysqli_fetch_assoc($result))
        {
            $action_delete = sprintf("../main/user_delete.php?user_id=%d", $arr['user_id']);
            $action_open = sprintf("../main/user_profile.php?user_id=%d", $arr['user_id']);
            echo "<div class='container '>";
                echo "<div class='element'>{$arr['user_id']}</div>";
                echo "<div class='element'>{$arr['first_name']} {$arr['last_name']}</div>";

                echo "<div class='element'>" .   "<a href=\"mailto:{$arr['email']}\">"    .   "{$arr['email']}</a>" . "</div>";

                echo "<div class='element'>" .    "<a href=\"{$action_delete}\">ERASE profile</a>"   .  "</div>";
                echo "<div class='element'>" .    "<a href=\"{$action_open}\">Open profile</a>"  . "</div>";
            echo "</div>";
        };

        ?>
    </div>

