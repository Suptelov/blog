<?php
 require_once("../database_connection.php");
 require_once("../app_config.php");

?>
<head>
    <style>
        
        th, td{
            border:2px solid grey;
            padding: 5px;

                
        }
        table{  border-collapse: collapse;}
        
    </style>

</head>
<div class="table">
    <table>
    <tr>
        <th>User ID</th>
        <th>User Name</th>
        <th>Send message to:</th>
        <th>Action1</th>
        <th>Action2</th>
    </tr>    
<?php
$query = "Select user_id, first_name, last_name, email From users";
$result = mysqli_query($link, $query);
$row_res = mysqli_fetch_row($result);
        
while($arr=mysqli_fetch_assoc($result))
{
    $action_delete = sprintf("../main/user_delete.php?user_id=%d", $arr['user_id']);
    $action_open = sprintf("../main/user_profile.php?user_id=%d", $arr['user_id']);
    echo "<tr>";
        echo "<td>{$arr['user_id']}</td>";
        echo "<td>{$arr['first_name']} {$arr['last_name']}</td>";

        echo "<td>" .   "<a href=\"mailto:{$arr['email']}\">"    .   "{$arr['email']}</a>" . "</td>";

        echo "<td>" .    "<a href=\"{$action_delete}\">ERASE profile</a>"   .  "</td>";
        echo "<td>" .    "<a href=\"{$action_open}\">Open profile</a>"  . "</td>";
    echo "</tr>";        
};
    ?>
   </table> 
    

</div>