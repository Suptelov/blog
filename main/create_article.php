<?php
require_once ("../app_config.php");
require_once ("../database_connection.php");
?>
<head>
    <link rel="stylesheet" type="text/css" href="http://localhost/training/main/mystyle.css">
</head>
<?php
require_once ("../views/header.php");
?>
    <form action="save_article.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <label for="title">Title</label>
            <input type="text" name="title" size=40 /> <br/>
            <div class="tags">
                    <label for="tag">Tag. Space between tag that symbol -> ;</label>
                    <input type="text" name="tag" size=220 /> <br/>

            </div>
            <p class="file-label">
                <label  for="content">Content:</label>
                <textarea name="content" cols="50" rows="15"></textarea>
            </p>

        </fieldset>
        <br/>
        <fieldset class="center">
            <input type="submit" value="Add Article"/>
            <input type="reset" value="Reset form"/>
        </fieldset>
</form>
