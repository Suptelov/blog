<?php
if(isset($_SESSION['user_id'])){
    echo "<div class='header'>
    <div class='son'>
        <a href='http://localhost/training/index.php'>
            <img style='width: 20px; height: 20px;' src='http://localhost/training/images/home.svg'>
        </a>
    </div>
    
    <div class='son'>
        <a href='http://localhost/training/views/users_list.php'>Users</a>
    </div>
    
    <div class='son'>
        <a href='http://localhost/training/views/articles.php'>Articles</a>
    </div>
    
    <div class='son'>
        <a href='http://localhost/training/main/user_profile.php?user_id= {$_SESSION['user_id'] }'>My Profile</a>
    </div>
    
    <div class='son'>
        <a href='http://localhost/training/views/user_articles.php?user_id={$_SESSION['user_id'] }'>My articles</a>
    </div>
    <div class='son'>
        <a href='http://localhost/training/main/log_out.php'>Log out</a>
    </div>
</div>";
}
else{
    echo "<div class='header'>
    <div class='son'>
       <a href='http://localhost/training/index.php'>
            <img style='width: 20px; height: 20px;' src='http://localhost/training/images/home.svg'>
        </a>
    </div>
    
    <div class='son'>
        <a href='http://localhost/training/views/users_list.php'>Users</a>
    </div>
    
    <div class='son'>
        <a href='http://localhost/training/views/articles.php'>Articles</a>
    </div>
    
    <div class='son'>
        <a href=''>Add article</a>
    </div>
    
    <div class='son'>
        <a href='http://localhost/training/views/articles.php'>My articles</a>
    </div>
</div>";
}

